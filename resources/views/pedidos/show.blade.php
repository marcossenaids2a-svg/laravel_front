@extends('layout.principal')
@section('title', 'Pedido | Robótica LMT')
@section('page-title', 'Detalhes do Pedido')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h3 fw-bold">Pedido #{{ $pedido->id }}</h1><p class="text-muted">Solicitação de material e decisão de disponibilidade.</p></div><div class="d-flex gap-2"><a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">Voltar</a><a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-sesi">Analisar pedido</a></div></div><div class="card card-clean p-4"><div class="row g-4">@foreach(['Usuário'=>$pedido->usuario->nome ?? '—','Material'=>$pedido->material->nome ?? '—','Quantidade'=>$pedido->item->quantidade ?? '—','Data do pedido'=>$pedido->data_pedido,'Status'=>ucfirst($pedido->status),'Observação'=>$pedido->observacao ?: '—'] as $label=>$value)<div class="col-md-4"><div class="small text-muted">{{ $label }}</div><div class="fw-semibold">{{ $value }}</div></div>@endforeach</div></div>
@endsection
