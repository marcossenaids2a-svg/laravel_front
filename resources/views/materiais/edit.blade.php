@extends('layout.principal')
@section('title', 'Editar Material | Robótica LMT')
@section('page-title', 'Editar Material')
@section('content')
<div class="mb-4"><h1 class="h3 fw-bold">Editar material</h1><p class="text-muted">Atualize as informações de {{ $material->nome }}.</p></div>
<form method="POST" action="{{ route('materiais.update', $material) }}" class="card card-clean p-4">@csrf @method('PUT') @include('materiais._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('materiais.show', $material) }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Salvar alterações</button></div></form>
@endsection
