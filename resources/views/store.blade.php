@extends('layouts.front')

@section('content')

<div class="row col-12">
  <div class="col-10">
    <h2 class="mt-4">{{ $store->name }}</h2>
    <p>{{ $store->description }}</p>
    <strong>Contatos:</strong>
    <p>{{ $store->phone }} | {{ $store->mobile_phone }}</p>
  </div>

  <div class="col-2">
    @if($store->logo)
    <img src="{{ asset('storage/'. $store->logo) }}" class="card-img-top" alt="Logo da loja {{ $store->name }}">
    @endif
  </div>
</div>
<hr>

<div class="dropdown mb-3">
  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Categorias
  </button>
  <ul class="dropdown-menu link-category" aria-labelledby="dropdownMenuButton1">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('store.single', ['slug'=> $store->slug]) }}">Todas as categorias</a>
    </li>
    @foreach($categoriesMenu as $categoryLink)
    <li class="nav-item">
      <a class="nav-link" href="http://127.0.0.1:8000/store/{{ $store->slug }}?category={{ $categoryLink->slug }}">{{ $categoryLink->name }}</a>
    </li>
    @endforeach
  </ul>
</div>

<h3 class="mb-3">Produtos</h3>
<div class="row">

@if($productsByStoreCategory)

  @forelse($productsByStoreCategory as $product)
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
  @empty
    <div class="col-12 alert alert-warning">Nenhum produto encontrado com essa categoria para essa loja</div>
  @endforelse

@else

  @forelse($store->products as $product)
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
  @empty
  <div class="col-12 alert alert-warning">Nenhum produto encontrado para essa loja</div>
  @endforelse

@endif
</div>

@endsection