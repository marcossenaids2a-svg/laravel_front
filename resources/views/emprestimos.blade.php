<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Empréstimos | Robótica LMT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('emprestimo.css') }}">
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

        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <span>⌂</span> Início
            </a>

            <a href="{{ route('materiais') }}" class="menu-link">
                <span>⬡</span> Materiais
            </a>

            <a href="{{ route('emprestimos') }}" class="menu-link active">
                <span>▤</span> Empréstimos
            </a>
            
             <a href="{{ route('pedidos') }}" class="menu-link">
            <span>☷</span> Pedidos
        </a>
        </nav>

        <div class="sidebar-footer">
            <small>UNIDADE LMT</small>
            <strong>Lab de Tecnologias</strong>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <h1>Empréstimos</h1>

            <div class="user-area">
                <div class="avatar">H</div>
                <div>
                    <strong>Usuário</strong>
                    <small>Administrador</small>
                </div>
            </div>
        </header>

        <section class="page-content">

            <div class="page-heading">
                <div>
                    <h2>Controle de Empréstimos</h2>
                    <p>Consulte e acompanhe os empréstimos de materiais do laboratório.</p>
                </div>

                <button type="button" class="btn-new" id="btnNovoEmprestimo">
                    + Novo empréstimo
                </button>
            </div>

            <div class="filters">
                <input
                    type="search"
                    id="busca"
                    class="form-control search-input"
                    placeholder="Buscar material ou responsável..."
                >

                <select id="filtroStatus" class="form-select status-select">
                    <option value="">Todos os status</option>
                    <option value="Ativo">Ativo</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Devolvido">Devolvido</option>
                </select>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table align-middle" id="tabelaEmprestimos">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Material</th>
                                <th>Responsável</th>
                                <th>Retirada</th>
                                <th>Devolução prevista</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr data-status="Ativo">
                                <td>EMP-001</td>
                                <td class="material-name">Arduino Uno R3</td>
                                <td>João Silva</td>
                                <td>05/10/2026</td>
                                <td>10/10/2026</td>
                                <td><span class="status active">Ativo</span></td>
                                <td>
                                    <button class="btn-action devolver">Devolver</button>
                                </td>
                            </tr>

                            <tr data-status="Pendente">
                                <td>EMP-002</td>
                                <td class="material-name">Kit LEGO Mindstorms EV3</td>
                                <td>Maria Oliveira</td>
                                <td>07/10/2026</td>
                                <td>12/10/2026</td>
                                <td><span class="status pending">Pendente</span></td>
                                <td>
                                    <button class="btn-action devolver">Devolver</button>
                                </td>
                            </tr>

                            <tr data-status="Ativo">
                                <td>EMP-003</td>
                                <td class="material-name">Sensor Ultrassônico HC-SR04</td>
                                <td>Pedro Santos</td>
                                <td>06/10/2026</td>
                                <td>09/10/2026</td>
                                <td><span class="status active">Ativo</span></td>
                                <td>
                                    <button class="btn-action devolver">Devolver</button>
                                </td>
                            </tr>

                            <tr data-status="Devolvido">
                                <td>EMP-004</td>
                                <td class="material-name">Multímetro Digital</td>
                                <td>Ana Costa</td>
                                <td>01/10/2026</td>
                                <td>04/10/2026</td>
                                <td><span class="status returned">Devolvido</span></td>
                                <td>
                                    <span class="text-muted">Concluído</span>
                                </td>
                            </tr>

                            <tr data-status="Ativo">
                                <td>EMP-005</td>
                                <td class="material-name">Raspberry Pi 4 Model B</td>
                                <td>Lucas Mendes</td>
                                <td>07/10/2026</td>
                                <td>14/10/2026</td>
                                <td><span class="status active">Ativo</span></td>
                                <td>
                                    <button class="btn-action devolver">Devolver</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="semResultados" class="empty-state d-none">
                        Nenhum empréstimo encontrado.
                    </div>
                </div>
            </div>

            <p class="demo-notice">
                Dados ilustrativos para demonstração. As alterações não são salvas.
            </p>

        </section>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('emprestimo.js') }}"></script>

</body>
</html>