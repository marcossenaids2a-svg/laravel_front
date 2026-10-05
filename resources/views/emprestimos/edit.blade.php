@extends('layout.principal')
@section('title', 'Editar Empréstimo | Robótica LMT')
@section('page-title', 'Editar Empréstimo')
@section('content')
<h1 class="h3 fw-bold">Editar empréstimo</h1><p class="text-muted mb-4">Revise os dados e o status da retirada.</p>
<form method="POST" action="{{ route('emprestimos.update', $emprestimo) }}" class="card card-clean p-4">@csrf @method('PUT') @include('emprestimos._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('emprestimos.show', $emprestimo) }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Salvar alterações</button></div></form>
@endsection
