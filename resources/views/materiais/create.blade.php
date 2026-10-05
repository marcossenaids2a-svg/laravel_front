@extends('layout.principal')
@section('title', 'Novo Material | Robótica LMT')
@section('page-title', 'Novo Material')
@section('content')
<div class="mb-4"><h1 class="h3 fw-bold">Cadastrar material</h1><p class="text-muted">Preencha os dados do item para incluí-lo no inventário.</p></div>
<form method="POST" action="{{ route('materiais.store') }}" class="card card-clean p-4">@csrf @include('materiais._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('materiais.index') }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Salvar material</button></div></form>
@endsection
