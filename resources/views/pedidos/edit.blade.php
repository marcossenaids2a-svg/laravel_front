@extends('layout.principal')
@section('title', 'Editar Pedido | Robótica LMT')
@section('page-title', 'Editar Pedido')
@section('content')
<h1 class="h3 fw-bold">Analisar pedido #{{ $pedido->id }}</h1><p class="text-muted mb-4">Confirme a disponibilidade antes de aprovar a retirada.</p><form method="POST" action="{{ route('pedidos.update', $pedido) }}" class="card card-clean p-4">@csrf @method('PUT') @include('pedidos._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Salvar decisão</button></div></form>
@endsection
