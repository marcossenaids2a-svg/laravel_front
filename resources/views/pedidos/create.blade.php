@extends('layout.principal')
@section('title', 'Novo Pedido | Robótica LMT')
@section('page-title', 'Novo Pedido')
@section('content')
<h1 class="h3 fw-bold">Solicitar material</h1><p class="text-muted mb-4">O pedido ficará pendente até a conferência do estoque.</p><form method="POST" action="{{ route('pedidos.store') }}" class="card card-clean p-4">@csrf @include('pedidos._form')<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">Cancelar</a><button class="btn btn-sesi">Enviar pedido</button></div></form>
@endsection
