@extends('layouts.app')

@section('content')
<h1>Criar produto</h1>

<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nome do produto</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Informaçoes</label>
        <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{ old('body') }}"></textarea>

        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Preço</label>
        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">

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
                <input type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->name }}
            @endforeach
        </div>  
    </div>
    <div class="form-group checkbox-padding">
        <label>Fotos do produto</label>
        <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

        @error('photos.*')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <input type="submit" class="btn btn-success btn-confirm" value="Cadastrar">
    </div>
</form>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
<script>
    $('#price').maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ','});
</script>

@endsection