@extends('layout.principal')

@section('title', 'Novo Usuário | Robótica LMT')
@section('page-title', 'Novo Usuário')

@section('content')

<div class="mb-4">
    <h1 class="h3 fw-bold mb-1">Novo Usuário</h1>
    <p class="text-muted mb-0">
        Cadastre um novo usuário no sistema.
    </p>
</div>

<div class="card card-clean p-4">

```
<form method="POST">

    @csrf

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input
                type="text"
                name="nome"
                class="form-control"
                value="{{ old('nome') }}"
                required
            >
        </div>

        <div class="col-md-6">
            <label class="form-label">E-mail</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="col-md-4">
            <label class="form-label">CPF</label>
            <input
                type="text"
                name="cpf"
                class="form-control"
                value="{{ old('cpf') }}"
            >
        </div>

        <div class="col-md-4">
            <label class="form-label">Data de nascimento</label>
            <input
                type="date"
                name="data_nascimento"
                class="form-control"
                value="{{ old('data_nascimento') }}"
            >
        </div>

        <div class="col-md-4">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select">
                <option value="">Selecione</option>
                <option value="admin">Administrador</option>
                <option value="usuario">Usuário</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Senha</label>
            <input
                type="password"
                name="senha"
                class="form-control"
                required
            >
        </div>

        <div class="col-md-6">
            <label class="form-label">Confirmar senha</label>
            <input
                type="password"
                name="senha_confirmation"
                class="form-control"
                required
            >
        </div>

    </div>

    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-sesi">
            <i class="fa-solid fa-check me-2"></i>
            Cadastrar
        </button>
    </div>

</form>
```

</div>

@endsection
