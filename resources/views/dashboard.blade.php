<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Robótica LMT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>
<body>

<div class="app-layout">

    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">R</div>
            <div>
                <strong>Robótica LMT</strong>
                <small>SESI • Educação</small>
            </div>
        </div>

        <p class="menu-label">MENU PRINCIPAL</p>

        <a href="{{ route('dashboard') }}" class="menu-link active">
            <span>▦</span> Visão geral
        </a>

        <a href="{{ route('materiais') }}" class="menu-link">
            <span>▤</span> Materiais
        </a>

        <a href="{{ route('emprestimos') }}" class="menu-link">
            <span>⇄</span> Empréstimos
        </a>

        <a href="{{ route('pedidos') }}" class="menu-link">
            <span>☷</span> Pedidos
        </a>

        <div class="sidebar-bottom">
            <div class="user-info">
                <div class="avatar">A</div>
                <div>
                    <strong>Administrador</strong>
                    <small>Acesso de demonstração</small>
                </div>
            </div>

            <a href="{{ route('logout') }}" class="logout-link">
                ↪ Sair do sistema
            </a>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div>
                <span class="breadcrumb-text">Robótica LMT /</span>
                <strong> Visão geral</strong>
            </div>
            <span class="system-status">● Sistema demonstrativo</span>
        </header>

        <section class="page-content">
            <div class="welcome-section">
                <div>
                    <h1>Painel Geral</h1>
                    <p>Bem-vindo ao sistema de gerenciamento de materiais.</p>
                </div>
                <span class="date-label">SESI • ROBÓTICA E LMT</span>
            </div>

            <div class="stats-grid">
                <article class="stat-card">
                    <span class="stat-icon red">▤</span>
                    <p>Total de materiais</p>
                    <h2>248</h2>
                    <small>Materiais cadastrados</small>
                </article>

                <article class="stat-card">
                    <span class="stat-icon blue">⇄</span>
                    <p>Empréstimos ativos</p>
                    <h2>12</h2>
                    <small>Em andamento</small>
                </article>

                <article class="stat-card">
                    <span class="stat-icon orange">☷</span>
                    <p>Pedidos pendentes</p>
                    <h2>5</h2>
                    <small>Aguardando análise</small>
                </article>

                <article class="stat-card">
                    <span class="stat-icon green">⚙</span>
                    <p>Em manutenção</p>
                    <h2>3</h2>
                    <small>Materiais em reparo</small>
                </article>
            </div>

            <div class="content-grid">
                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Visão do estoque</h3>
                            <p>Exemplo de distribuição de materiais</p>
                        </div>
                    </div>

                    <div class="chart-placeholder">
                        <div class="chart-row">
                            <span>Robótica</span>
                            <div class="chart-track">
                                <div class="chart-bar bar-one"></div>
                            </div>
                            <strong>80%</strong>
                        </div>

                        <div class="chart-row">
                            <span>Eletrônica</span>
                            <div class="chart-track">
                                <div class="chart-bar bar-two"></div>
                            </div>
                            <strong>65%</strong>
                        </div>

                        <div class="chart-row">
                            <span>Matemática</span>
                            <div class="chart-track">
                                <div class="chart-bar bar-three"></div>
                            </div>
                            <strong>45%</strong>
                        </div>

                        <div class="chart-row">
                            <span>Informática</span>
                            <div class="chart-track">
                                <div class="chart-bar bar-four"></div>
                            </div>
                            <strong>30%</strong>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Acesso rápido</h3>
                            <p>Navegue pelo sistema</p>
                        </div>
                    </div>

                    <a href="#" class="quick-link">
                        <span class="quick-icon">＋</span>
                        <span>
                            <strong>Materiais</strong>
                            <small>Consultar o inventário</small>
                        </span>
                        <span class="arrow">›</span>
                    </a>

                    <a href="#" class="quick-link">
                        <span class="quick-icon">⇄</span>
                        <span>
                            <strong>Empréstimos</strong>
                            <small>Consultar empréstimos</small>
                        </span>
                        <span class="arrow">›</span>
                    </a>

                    <a href="#" class="quick-link">
                        <span class="quick-icon">☷</span>
                        <span>
                            <strong>Pedidos</strong>
                            <small>Consultar solicitações</small>
                        </span>
                        <span class="arrow">›</span>
                    </a>
                </section>
            </div>

            <div class="demo-notice">
                <strong>Modo de demonstração:</strong>
                os números apresentados são fictícios e não representam
                o estoque real do laboratório.
            </div>

        </section>
    </main>

</div>

</body>
</html>