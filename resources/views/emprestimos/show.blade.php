@extends('layout.principal')
@section('title', 'Empréstimo | Robótica LMT')
@section('page-title', 'Detalhes do Empréstimo')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h3 fw-bold">Empréstimo #{{ $emprestimo->id }}</h1><p class="text-muted">Detalhes da retirada registrada.</p></div><div class="d-flex gap-2"><a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary">Voltar</a><a href="{{ route('emprestimos.edit', $emprestimo) }}" class="btn btn-sesi">Editar</a></div></div>
<div class="card card-clean p-4"><div class="row g-4">@foreach(['Usuário' => $emprestimo->usuario->nome ?? '—','Material' => $emprestimo->material->nome ?? '—','Quantidade' => $emprestimo->item->quantidade ?? '—','Data do empréstimo' => $emprestimo->data_emprestimo,'Devolução' => $emprestimo->data_devolucao ?: '—','Status' => ucfirst($emprestimo->status),'Observação' => $emprestimo->observacao ?: '—'] as $label=>$value)<div class="col-md-4"><div class="small text-muted">{{ $label }}</div><div class="fw-semibold">{{ $value }}</div></div>@endforeach</div></div>
@endsection
