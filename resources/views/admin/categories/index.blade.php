@extends('layouts.app')

@section('content')
<a href=" {{route('admin.categories.create')}} " class="btn btn-primary btn-new"><i class="fa-solid fa-plus"></i> Criar categoria</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category) 
            @include('includes.modal')
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['category'=> $category->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCategory-{{ $category->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Deletar<a>
                </td>
            </tr>
        @endforeach
    </tbody>    
</table>

{{ $categories->links() }}
@endsection