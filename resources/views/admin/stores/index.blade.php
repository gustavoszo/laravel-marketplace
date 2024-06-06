@extends('layouts.app')

@section('content')

@if(! $store )
<a href=" {{route('admin.stores.create')}} " class="btn btn-primary btn-new"><i class="fa-solid fa-plus"></i> Criar loja</a>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Quantidade de produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @if($store)
        @include('includes.modal')
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>{{ $store->products->count() }}</td>
            <td>
                <a href="{{ route('admin.stores.edit', ['store'=> $store->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteStore-{{ $store->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Deletar<a>
            </td>
        </tr>
        @endif
    </tbody>    
</table>

@endsection