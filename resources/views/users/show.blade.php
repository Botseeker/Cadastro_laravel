@extends('layouts.admin')

@section('content')
 
        <div class="content">
            <div class="content-title">
                <h1 class="page-title">Detalhes do usuário</h1>
                <div class="mb-2">
                    <a href="{{ route('user.index') }}" class="btn-info">Listar</a>
                    <a href="{{ route('user.edit', ['user' => $user->id ]) }}" class="btn-warning">Editar </a>
                    <a href="{{ route('user.edit-password', ['user' => $user->id]) }}" class="btn-warning">Editar Senha</a>
                </div>
            </div>

            <x-alert />

            <div class="mb-1">
                <span class="font-bold">ID: </span>
                <span>{{ $user->id }}</span>
            </div>
            <div class="mb-1">
                <span class="font-bold">Nome: </span>
                <span>{{ $user->name }}</span>
            </div>
            <div class="mb-1">
                <span class="font-bold">Nome: </span>
                <span>{{ $user->email }}</span>
            </div>
            <div class="mb-1">
                <span class="font-bold">Criado em: </span>
                <span>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="mb-1">
                <span class="font-bold">Editado em: </span>
                <span>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>
    
@endsection
