@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Carrinho de compras</h2>
        <hr>
    </div>
    @php $total = 0; @endphp
    <div class="col-12">
        @if($cart)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preco</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $c)
                @php
                    $subtotal = $c['price'] * $c['amount'];
                    $total += $subtotal;
                @endphp
                    <tr>
                        <td>{{ $c['name'] }}</td>
                        <td>{{ $c['price'] }}</td>
                        <td>{{ $c['amount'] }}</td>
                        <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td><a href="{{ route('cart.remove', ['slug'=> $c['slug']]) }}" class="btn btn-danger">Remover</a></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total:</td>
                    <td colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>   
            </tbody>
        </table>
        <div class="col-md-12">
            <a href="{{ route('cart.cancel') }}" class="btn btn-danger">Cancelar compra</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-buy">Concluir compra</a>
        </div>
        @else
        <div class="no-cart">
            <p class="text-secondary"><i class="fa-solid fa-cart-shopping"></i> Carrinho vazio</p>
        </div>
        @endif
    </div>
</div>

@endsection