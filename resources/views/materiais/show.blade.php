@extends('layout.principal')
@section('title', $material->nome.' | Materiais')
@section('page-title', 'Detalhes do Material')
@section('content')
<div class="d-flex justify-content-between align-items-start mb-4"><div><h1 class="h3 fw-bold mb-1">{{ $material->nome }}</h1><p class="text-muted mb-0">Código {{ $material->codigo }}</p></div><div class="d-flex gap-2"><a href="{{ route('materiais.index') }}" class="btn btn-outline-secondary">Voltar</a><a href="{{ route('materiais.edit', $material) }}" class="btn btn-sesi"><i class="fa-solid fa-pen me-2"></i>Editar</a></div></div>
<div class="card card-clean p-4"><div class="row g-4">@foreach(['Descrição' => $material->descricao ?: '—','Categoria ID' => $material->id_categoria ?: '—','Localização ID' => $material->id_localizacao ?: '—','Tipo' => $material->tipo_material ?: '—','Quantidade total' => $material->quantidade,'Disponível' => $material->quantidade_disponivel,'Quantidade mínima' => $material->quantidade_minima ?? '—','Estado' => $material->estado] as $label => $value)<div class="col-sm-6 col-lg-4"><div class="small text-muted mb-1">{{ $label }}</div><div class="fw-semibold">{{ $value }}</div></div>@endforeach</div></div>
@endsection
