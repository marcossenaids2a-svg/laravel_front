@extends('layout.principal')
@section('title', 'Novo Empréstimo | Robótica LMT')
@section('page-title', 'Novo Empréstimo')
@section('content')
<h1 class="h3 fw-bold">Registrar empréstimo</h1><p class="text-muted mb-4">Informe quem retirou o material e a previsão de devolução.</p>
<form method="POST" action="{{ route('emprestimos.store') }}" class="card card-clean p-4">@csrf @include('emprestimos._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Salvar empréstimo</button></div></form>
@endsection
