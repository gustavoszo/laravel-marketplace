@extends('layouts.app')

@section('content')
<h1>Criar loja</h1>

<form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Descrição da loja</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">

        @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mt-2">
        <label>Celular</label>
        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ old('mobile_phone') }}">

        @error('mobile_phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group checkbox-padding">
        <label>Logo da loja</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">

        @error('logo')
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

<!-- dependencia para mascara de telefone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
        $(document).ready(function(){
            $('#mobile_phone').mask('(00) 00000-0000');
        });
</script>

@endsection