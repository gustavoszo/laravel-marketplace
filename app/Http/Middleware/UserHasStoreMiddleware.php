<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHasStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(auth()->user()->store()->count()) {
            return redirect()->route('admin.stores.index')->with('warning', 'Você já possui uma loja');
        }
        // a função $next é uma Closure que representa a próxima etapa na cadeia de manipulação de solicitações HTTP. Quando você chama $next($request), você está dizendo ao middleware para continuar a execução da solicitação, passando-a para o próximo middleware ou controlador na cadeia.
        return $next($request);
    }
}
