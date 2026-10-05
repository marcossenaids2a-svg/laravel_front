<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Robótica LMT')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root{--sesi-red:#ff0000;--ink:#171717;--muted:#737373;--line:#e8e8e8;--canvas:#f6f6f6}
        body{margin:0;background:var(--canvas);color:var(--ink);font-family:Arial,sans-serif}
        .app-sidebar{position:fixed;inset:0 auto 0 0;width:240px;background:#111;color:#fff;padding:24px 14px;display:flex;flex-direction:column;z-index:1030}
        .brand{display:flex;align-items:center;gap:11px;padding:3px 10px 25px;border-bottom:1px solid #292929;color:#fff;text-decoration:none}
        .brand-icon{width:38px;height:38px;background:var(--sesi-red);border-radius:9px;display:grid;place-items:center}
        .brand strong{display:block;font-size:15px}.brand small{color:#aaa;letter-spacing:1.5px;font-size:9px}
        .app-nav{padding-top:20px}.app-nav a{display:flex;align-items:center;gap:12px;color:#bbb;text-decoration:none;padding:12px 14px;border-radius:7px;margin-bottom:5px;font-size:14px;border-left:3px solid transparent}
        .app-nav a:hover{background:#202020;color:#fff}.app-nav a.active{background:#281111;color:#fff;border-left-color:var(--sesi-red)}.app-nav a.active i{color:var(--sesi-red)}
        .sidebar-foot{margin-top:auto;padding:15px 10px;border-top:1px solid #292929;color:#777;font-size:11px}
        .app-main{margin-left:240px;min-height:100vh}.topbar{height:70px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 30px;position:sticky;top:0;z-index:1020}
        .topbar-title{font-weight:700;font-size:17px}.topbar-right{display:flex;align-items:center;gap:22px}.top-search{background:#f5f5f5;border-radius:7px;padding:8px 11px;color:#888}.top-search input{border:0;outline:0;background:transparent;font-size:13px;width:190px}.user-label{font-size:13px;font-weight:600}.page-content{padding:28px 30px}.card-clean{border:1px solid var(--line);border-radius:10px;box-shadow:0 3px 12px #00000008}.btn-sesi{background:var(--sesi-red);color:white;border-color:var(--sesi-red)}.btn-sesi:hover{background:#d90000;color:#fff;border-color:#d90000}.table thead th{font-size:11px;text-transform:uppercase;letter-spacing:.04em;color:#777;white-space:nowrap}.table td{vertical-align:middle}.text-muted{color:var(--muted)!important}
        @media(max-width:768px){.app-sidebar{width:68px;padding:17px 7px}.brand{justify-content:center;padding:0 0 18px}.brand>div:last-child,.app-nav span,.sidebar-foot{display:none}.app-nav a{justify-content:center;padding:12px 0}.app-main{margin-left:68px}.topbar{height:auto;min-height:64px;padding:12px 16px}.topbar-right{gap:10px}.top-search{display:none}.page-content{padding:18px 14px}}
    </style>
    @stack('styles')
</head>
<body>
<aside class="app-sidebar">
    <a class="brand" href="{{ route('dashboard') }}"><span class="brand-icon"><i class="fa-solid fa-robot"></i></span><div><strong>Robótica LMT</strong><small>SESI LAB</small></div></a>
    <nav class="app-nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><span>Início</span></a>
        <a href="{{ route('materiais.index') }}" class="{{ request()->routeIs('materiais.*') ? 'active' : '' }}"><i class="fa-solid fa-box"></i><span>Materiais</span></a>
        <a href="{{ route('emprestimos.index') }}" class="{{ request()->routeIs('emprestimos.*') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding"></i><span>Empréstimos</span></a>
        <a href="{{ route('pedidos.index') }}" class="{{ request()->routeIs('pedidos.*') ? 'active' : '' }}"><i class="fa-solid fa-clipboard-list"></i><span>Pedidos</span></a>
    </nav>
    <div class="sidebar-foot">LABORATÓRIO DE TECNOLOGIA</div>
</aside>
<main class="app-main">
    <header class="topbar"><div class="topbar-title">@yield('page-title', 'Início')</div><div class="topbar-right"><form class="top-search" action="{{ request()->routeIs('materiais.*') ? route('materiais.index') : (request()->routeIs('emprestimos.*') ? route('emprestimos.index') : (request()->routeIs('pedidos.*') ? route('pedidos.index') : route('materiais.index'))) }}" method="GET"><i class="fa-solid fa-magnifying-glass me-2"></i><input name="busca" value="{{ request('busca') }}" placeholder="Pesquisar"></form><span class="user-label"><i class="fa-regular fa-user me-2"></i>{{ session('usuario_nome', 'Usuário') }}</span><form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-sm btn-outline-secondary" type="submit" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></button></form></div></header>
    <section class="page-content">
        @if(session('success'))<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>@endif
        @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        @yield('content')
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body></html>
