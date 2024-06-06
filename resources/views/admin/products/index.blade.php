@extends('layouts.app')

@section('content')
<a href=" {{route('admin.products.create')}} " class="btn btn-primary btn-new"><i class="fa-solid fa-plus"></i> Criar produto</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @if($products)
        @foreach($products as $product) 
            @include('includes.modal')
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                <td>{{ $product->store->name }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', ['product'=> $product->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteProduct-{{ $product->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Deletar<a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>    
</table>

{{ $products->links() }}
@endsection