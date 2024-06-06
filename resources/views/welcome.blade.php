@extends('layouts.front')

@section('content')

<div class="row">
@foreach($products as $product)
    <div class="col-4">
        <div class="card mb-4" style="width: 98%">
            @if($product->photos->count())
            <img src="{{ asset('storage/'. $product->photos->first()->image) }}" class="card-img-top" alt="Imagem do produto {{ $product->name }}">
            @else
            <img src="{{ asset('assets/img/produto-sem-imagem.png')}}" class="card-img-top" alt="Imagem do produto {{ $product->name }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <h3>R$ {{ number_format($product->price, 2, ',', '.') }}</h3>
                <a href="{{ route('product.single', ['slug'=> $product->slug]) }}" class="btn btn-primary">Ver produto</a>
            </div>
        </div>
    </div>
@endforeach
</div>

<h2 class="mt-4">Lojas em destaque</h2>
<hr>
<div class="row">
    @foreach($stores as $store)
        <div class="col-4">
        @if($store->logo)
            <img src="{{ asset('storage/'. $store->logo) }}" class="img-fluid" alt="Logo da loja {{ $store->name }}">
        @else
            <img src="https://via.placeholder.com/600X300.png?text=logo" class="img-fluid" alt="Loja sem logo...">
        @endif

        <h3>{{ $store->name }}</h3>
        <p>{{ $store->description }}</p>
        </div>
    @endforeach 
</div>
    
@endsection