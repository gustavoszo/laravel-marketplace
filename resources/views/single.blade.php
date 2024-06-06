@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-6">
        @if($product->photos->count())
        <img src="{{ asset('storage/'. $product->photos->first()->image) }}" class="card-img-top main-img" alt="Imagem do produto {{ $product->name }}">
        <div class="row mt-2">
            @foreach($product->photos as $photo)
                <div class="col-4">
                    <img src="{{ asset('storage/'. $photo->image) }}" class="card-img-top" alt="Imagem do produto {{ $product->name }}">
                </div>
            @endforeach
        </div>
        @else
        <img src="{{ asset('assets/img/produto-sem-imagem.png')}}" class="card-img-top" alt="Imagem do produto {{ $product->name }}">
        @endif
    </div>
    <div class="col-6">
        <div>
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            
            <h3>R$ {{ number_format($product->price, 2, ',', '.') }}</h3>
            
            <span>Loja: {{ $product->store->name }}</span>
        </div>
        <hr>
        <div>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="product[name]" value="{{ $product->name }}">
                <input type="hidden" name="product[price]" value="{{ $product->price }}">
                <input type="hidden" name="product[slug]" value="{{ $product->slug }}">
                <label>Quantidade</label>
                <input type="number" name="product[amount]" class="form-control" value="1">
               
                <input type="submit" class="btn btn-danger mt-3" value="Comprar">
            </form>
        </div>
    </div>

</div>
<hr>

<div class="col-12">
    {{ $product->body }}
</div>
@endsection
