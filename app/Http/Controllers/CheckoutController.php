<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    
    public function index()
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        session()->forget('pagseguro_session_code');
        $this->makePagseguroSession();

        $cartItems = session()->get('cart');

        $cartPrices = array_map(function($line) {
            return $line['amount'] * $line['price'];
        }, $cartItems);

        $total = array_sum($cartPrices);

        return view('checkout', ['total'=> $total]);

    }

    public function proccess(Request $request)
    {

        //Instantiate a new direct payment request, using Credit Card
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        $reference = 'XPTO';
        $creditCard->setReference($reference);
        $creditCard->setCurrency("BRL");

        // Add an item for this payment request
        $cartItems = session()->get('cart');

        foreach($cartItems as $item) {

            $creditCard->addItems()->withParameters(
                $reference,
                $item['name'],
                intval($item['amount']),
                floatval($item['price'])
            );
        }

        // Set your customer information.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        $user = auth()->user();
        // $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'teste@sandbox.pagseguro.com.br' : $user->email;
        $email = 'teste@sandbox.pagseguro.com.br';

        $creditCard->setSender()->setName('Gustavo Souza');
        $creditCard->setSender()->setEmail($email);

        // Poderia pegar no cadastro do usuário
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '86329232342'
        );

        $dataPost = $request->all();
        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //Set billing information for credit card
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        // Set credit card token
        $creditCard->setToken($dataPost['card_token']);

        // Set the installment quantity and value (could be obtained using the Installments
        // service, that have an example here in \public\getInstallments.php)
        $installment = explode('|', $dataPost['installment']);
        $creditCard->setInstallment()->withParameters(intval($installment[0]), floatval($installment[1]));

        // Set the credit card holder information
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        // $creditCard->setHolder()->setName($dataPost['card_name']); //Equals in Credit Card
        $creditCard->setHolder()->setName('Gustavo de Souza Oliveira'); //Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '86329232342'
        );

        // Set the Payment Mode for this payment request
        $creditCard->setMode('DEFAULT');

        //Get the crendentials and register the credit card payment
        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );
        
        print_r($result);
    }

    private function makePagseguroSession()
    {

        if(! session()->has('pagseguro_session_code')) {

            // Recebe o código gerado no backend do pagseguro para a identificação da transação
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code', $sessionCode->getResult());

        }

    }

}
