@extends('layouts.app')

@section('content')
<h1>Editar loja</h1>

<form action="{{ route('admin.stores.update', ['store'=> $store->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="name" class="form-control @error('phone') is-invalid @enderror" value="{{$store->name}}">
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" class="form-control" value="{{$store->description}}">
    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control" value="{{$store->phone}}">
    </div>
    <div class="form-group">
        <label>Celular</label>
        <input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}">
    </div>
    <div class="form-group checkbox-padding">
        <p>
            <img src="{{ asset('storage/'. $store->logo) }}" alt="Logo da loja" class="img-fluid @error('logo) is-invalid @enderror">
        </p>
        <label>Logo da loja</label>
        <input type="file" name="logo" class="form-control">

        @error('logo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <input type="submit" class="btn btn-success btn-confirm" value="Atualizar">
    </div>
</form>
@endsection