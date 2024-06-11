@extends('layouts.app')

@section('content')
<h1>Editar produto</h1>

<form action="{{ route('admin.products.update', ['product'=> $product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nome do produto</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}"> 

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $product->description }}">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Informações</label>
        <textarea name="body" class="form-control @error('body') is-invalid @enderror" cols="30" rows="10">{{ $product->body }}</textarea>

        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Preço</label>
        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}">

        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group checkbox-padding">
        <label>Categorias do produto</label>
        <div class="form-group">
            @foreach($categories as $category)
                <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                @if($product->categories->contains($category)) checked @endif
                > {{ $category->name }}
            @endforeach
        </div>  
    </div>
    <div class="form-group checkbox-padding">
        <label>Fotos do produto</label>
        <input type="file" name="photos[]" class="form-control @error('photos.*')) is-invalid @enderror" multiple>

        @error('photos.*')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    
    <div>
        <input type="submit" class="btn btn-success btn-confirm" value="Atualizar">
    </div>
</form>

<hr>

<div class="row">
    @foreach($product->photos as $photo)
        <div class="col-4 text-center">
            <img src="{{asset('storage/'.$photo->image)}}" alt="Imagem do produto" class="img-fluid">
            <form action="{{ route('admin.photo.remove') }}" method="post">
                @csrf
                <input type="hidden" name="photoName" value="{{ $photo->image }}">
                <input type="submit" class="btn btn-danger" value="Remover">
            </form>
        </div>
    @endforeach 
</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
<script>
    $('#price').maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ','});
</script>

@endsection