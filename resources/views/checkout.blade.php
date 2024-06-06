@extends('layouts.front')

@section('content')

<div class="col-6">
    <h2>Dados para pagamento</h2>
    <hr>
    <form action="" method="post">
        <div class="form-group" class="mt-2">
            <label>Número do cartão</label> <span class="brand"></span>
            <input type="text" name="card_number" class="form-control">
            <input type="hidden" name="brand">
        </div>
        <div class="form-group" class="mt-3">
            <label>Nome impresso no cartão</label>
            <input type="text" name="card_name" class="form-control">
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <label>Mês de expiração</label>
                <input type="text" name="card_month" class="form-control">
            </div>
            <div class="col-4">
                <label>Ano de expiração</label>
                <input type="text" name="card_year" class="form-control">
            </div>
        </div>
        <div class="form-group col-5 mt-3">
            <label>Código de segurança</label>
            <input type="text" name="card_cvv" class="form-control">
        </div>
        <div class="form-group col-12 mt-3 installments">
           
        </div>

        <button class="btn btn-success btnConfirm mt-3" value="Efetuar pagamento">
    </form>

</div>

@endsection

@section('scripts')
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="{{asset('assets/js/jquery-ajax.js')}}"></script>
<script>
    const sessionId = '{{session()->get("pagseguro_session_code")}}';

//     Esta linha configura o ID da sessão para o PagSeguro usando a API do PagSeguro.
//     PagSeguroDirectPayment é um objeto fornecido pelo PagSeguro para facilitar pagamentos diretos.
    PagSeguroDirectPayment.setSessionId(sessionId);
</script>

<script>
    let spanBrand = document.querySelector('.brand');

    let totalCart = '{{ $total }}'

    let cardNumber = document.querySelector('input[name=card_number]'); 
    cardNumber.addEventListener('keyup', function() {
        if (cardNumber.value.length >= 6) {
            // O método getBrand da API do PagSeguro é chamado para obter a bandeira (marca) do cartão de crédito com base nos primeiros 6 dígitos do número do cartão (conhecidos como BIN).
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.value.substr(0, 6),
                success: function(res) {
                    let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`
                    spanBrand.innerHTML = imgFlag;

                    getInstallments(totalCart, res.brand.name);

                    console.log("Success:", res);
                },
                error: function(err) {
                    console.log("Error:", err);
                },
                complete: function(res) {
                    console.log("Complete:", res);
                }
            });
        }
    });

    let btnConfirm = document.querySelector('button.btnConfirm');
    btnConfirm.addEventListener('click', function(event) {
        // Executar antes do submit (evento padrão do botão)
        event.preventDefault();

        // O método createCardToken utiliza os dados do cartão de crédito para gerar um token (token do cartão), pois por motivos de segurança os dados do cartão não são enviados diretamente na chamada.
        PagSeguroDirectPayment.createCardToken({
            cardNumber: document.querySelector('input[name=card_number]').value,
            brand: document.querySelector('input[name=brand]').value,
            cvv: document.querySelector('input[name=card_cvv]').value,
            expirationMonth: document.querySelector('input[name=card_month]').value,
            expirationYear: document.querySelector('input[name=card_year]').value,
            success: function(res) {
                console.log(res)
                processPayment(res.card.token)
            }
        })
    })

    function getInstallments(amount, brand) {
        PagSeguroDirectPayment.getInstallments({
            amount: amount,
            brand: brand,
            // O número máximo de parcelas sem juros. Um valor de 0 significa que você está interessado em todas as opções de parcelamento, independentemente dos juros.
            maxInstallmentNoInterest: 0,
            success: function(res) {
                let selectInstallments = drawSelectInstallments(res.installments[brand]);
                document.querySelector('.installments').innerHTML = selectInstallments;
                console.log(res);
            },
            error: function(err) {
                console.log(err);
            },
            complete: function(res) {
                console.log(res);
            }
        })
    }

    function drawSelectInstallments(installments) {
		let select = '<label>Opções de Parcelamento:</label>';

		select += '<select class="form-control selectInstallment">';

		for(let l of installments) {
		    select += `<option value='${l.quantity}|${l.installmentAmount}'>${l.quantity}x de R$ ${l.installmentAmount} - Total: R$ ${l.totalAmount}</option>`;
		}

		select += '</select>';

		return select;
	}


    function processPayment(token) {
        // A função processPayment é uma função para processar pagamentos via Ajax. Ela coleta alguns dados (um token, um hash de segurança e uma informação sobre parcelas), e então envia esses dados para um servidor através de uma requisição AJAX.
        PagSeguroDirectPayment.onSenderHashReady(function(response) {
            if(response.status == 'error') {
                console.log("caiu no erro do onSenderHashReady: " + response.message);
                return false;
            }
            var hash = response.senderHash; // Hash estará disponível nesta variável.

            let data = {
                card_token: token,
                hash: hash, 
                installment: document.querySelector('.selectInstallment').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{ csrf_token() }}'

            }

            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/checkout/proccess',  
                data: data,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                }
            });
        });
    }

</script>

@endsection