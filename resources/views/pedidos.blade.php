<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pedidos | Robótica LMT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('pedidos.css') }}">
</head>
<body>

<div class="app-layout">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">▣</div>
            <div>
                <strong>Robótica LMT</strong>
                <small>SESI LAB</small>
            </div>
        </div>

        <p class="menu-label">MENU PRINCIPAL</p>

        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <span>⌂</span> Início
            </a>

            <a href="{{ route('materiais') }}" class="menu-link">
                <span>⬡</span> Materiais
            </a>

            <a href="{{ route('emprestimos') }}" class="menu-link">
                <span>▤</span> Empréstimos
            </a>

            <a href="{{ route('pedidos') }}" class="menu-link active">
                <span>▧</span> Pedidos
            </a>
        </nav>

        <div class="sidebar-footer">
            <small>UNIDADE LMT</small>
            <strong>Lab de Tecnologias</strong>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <h1>Pedidos de Materiais</h1>

            <div class="user-area">
                <div class="avatar">A</div>
                <div>
                    <strong>Administrador</strong>
                    <small>Robótica LMT</small>
                </div>
            </div>
        </header>

        <section class="page-content">

            <div class="page-heading">
                <div>
                    <h2>Solicitações do laboratório</h2>
                    <p>Consulte e acompanhe as solicitações de materiais da Robótica e do LMT.</p>
                </div>

                <button type="button" class="btn-new" id="btnNovoPedido">
                    + Novo pedido
                </button>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">▤</div>
                    <div>
                        <p>Total de pedidos</p>
                        <h3 id="totalPedidos">6</h3>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon pending-icon">◷</div>
                    <div>
                        <p>Pendentes</p>
                        <h3 id="totalPendentes">3</h3>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon approved-icon">✓</div>
                    <div>
                        <p>Aprovados</p>
                        <h3 id="totalAprovados">2</h3>
                    </div>
                </div>
            </div>

            <div class="filters">
                <div class="search-box">
                    <span>⌕</span>
                    <input
                        type="search"
                        id="buscaPedido"
                        placeholder="Buscar por pedido, material ou solicitante..."
                    >
                </div>

                <select id="filtroStatus" class="form-select">
                    <option value="">Status: Todos</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Aprovado">Aprovado</option>
                    <option value="Recusado">Recusado</option>
                </select>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table align-middle" id="tabelaPedidos">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Solicitante</th>
                                <th>Material solicitado</th>
                                <th>Quantidade</th>
                                <th>Data do pedido</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr data-status="Pendente">
                                <td>PED-001</td>
                                <td>João Silva</td>
                                <td class="material-name">Arduino Uno R3</td>
                                <td>2 un.</td>
                                <td>07/10/2026</td>
                                <td><span class="status pending">Pendente</span></td>
                                <td class="actions">
                                    <button class="btn-action aprovar">Aprovar</button>
                                    <button class="btn-action recusar">Recusar</button>
                                </td>
                            </tr>

                            <tr data-status="Aprovado">
                                <td>PED-002</td>
                                <td>Maria Oliveira</td>
                                <td class="material-name">Sensor Ultrassônico HC-SR04</td>
                                <td>5 un.</td>
                                <td>06/10/2026</td>
                                <td><span class="status approved">Aprovado</span></td>
                                <td class="actions">
                                    <span class="text-muted">Em andamento</span>
                                </td>
                            </tr>

                            <tr data-status="Pendente">
                                <td>PED-003</td>
                                <td>Pedro Santos</td>
                                <td class="material-name">Protoboard 830 pontos</td>
                                <td>3 un.</td>
                                <td>07/10/2026</td>
                                <td><span class="status pending">Pendente</span></td>
                                <td class="actions">
                                    <button class="btn-action aprovar">Aprovar</button>
                                    <button class="btn-action recusar">Recusar</button>
                                </td>
                            </tr>

                            <tr data-status="Recusado">
                                <td>PED-004</td>
                                <td>Ana Costa</td>
                                <td class="material-name">Kit LEGO Mindstorms EV3</td>
                                <td>2 kits</td>
                                <td>04/10/2026</td>
                                <td><span class="status rejected">Recusado</span></td>
                                <td class="actions">
                                    <span class="text-muted">Finalizado</span>
                                </td>
                            </tr>

                            <tr data-status="Pendente">
                                <td>PED-005</td>
                                <td>Lucas Mendes</td>
                                <td class="material-name">Micro Servo Motor SG90</td>
                                <td>4 un.</td>
                                <td>07/10/2026</td>
                                <td><span class="status pending">Pendente</span></td>
                                <td class="actions">
                                    <button class="btn-action aprovar">Aprovar</button>
                                    <button class="btn-action recusar">Recusar</button>
                                </td>
                            </tr>

                            <tr data-status="Aprovado">
                                <td>PED-006</td>
                                <td>Beatriz Lima</td>
                                <td class="material-name">Kit de Resistores</td>
                                <td>2 kits</td>
                                <td>05/10/2026</td>
                                <td><span class="status approved">Aprovado</span></td>
                                <td class="actions">
                                    <span class="text-muted">Em andamento</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="semResultados" class="empty-state d-none">
                        Nenhum pedido encontrado.
                    </div>
                </div>

                <div class="table-footer">
                    <span id="contadorPedidos">Exibindo 6 pedidos</span>
                    <span>Dados demonstrativos</span>
                </div>
            </div>

            <p class="demo-notice">
                Dados fictícios para prototipação. Aprovações e recusas não são salvas.
            </p>

        </section>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('pedidos.js') }}"></script>

</body>
</html>