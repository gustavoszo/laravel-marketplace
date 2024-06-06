@extends('layouts.app')

@section('content')
<h1>Editar categoria</h1>

<form action="{{ route('admin.categories.update', ['category'=> $category->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}"> 

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $category->description }}">

        @error('description')
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