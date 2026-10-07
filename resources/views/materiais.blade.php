<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Materiais | Robótica LMT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('materiais.css') }}">
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

            <a href="{{ route('materiais') }}" class="menu-link active">
                <span>⬡</span> Materiais
            </a>

            <a href="{{ route('emprestimos') }}" class="menu-link">
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
            <h1>Inventário de Materiais</h1>

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
                    <h2>Materiais do laboratório</h2>
                    <p>Consulte os equipamentos e componentes disponíveis para as atividades de robótica.</p>
                </div>

                <button type="button" class="btn-new" id="btnNovoMaterial">
                    + Novo material
                </button>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <span class="summary-icon">▤</span>
                    <div>
                        <p>Total de materiais</p>
                        <h3 id="totalMateriais">12</h3>
                    </div>
                </div>

                <div class="summary-card">
                    <span class="summary-icon available-icon">✓</span>
                    <div>
                        <p>Disponíveis</p>
                        <h3 id="totalDisponiveis">11</h3>
                    </div>
                </div>

                <div class="summary-card">
                    <span class="summary-icon loan-icon">⇄</span>
                    <div>
                        <p>Em uso / empréstimo</p>
                        <h3 id="totalEmprestados">1</h3>
                    </div>
                </div>
            </div>

            <div class="filters">
                <div class="search-box">
                    <span>⌕</span>
                    <input
                        type="search"
                        id="buscaMaterial"
                        placeholder="Buscar por nome ou código..."
                    >
                </div>

                <select id="filtroCategoria" class="form-select">
                    <option value="">Categoria: Todas</option>
                    <option value="Robótica">Robótica</option>
                    <option value="Eletrônica">Eletrônica</option>
                    <option value="Sensores">Sensores</option>
                    <option value="Ferramentas">Ferramentas</option>
                    <option value="Processamento">Processamento</option>
                    <option value="Mecânica">Mecânica</option>
                </select>

                <select id="filtroDisponibilidade" class="form-select">
                    <option value="">Disponibilidade: Todas</option>
                    <option value="Disponível">Disponível</option>
                    <option value="Em uso">Em uso</option>
                </select>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table align-middle" id="tabelaMateriais">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome do item</th>
                                <th>Categoria</th>
                                <th>Localização</th>
                                <th>Estoque</th>
                                <th>Disponíveis</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr data-categoria="Eletrônica" data-disponibilidade="Disponível">
                                <td>MAT-001</td>
                                <td class="material-name">Arduino Uno R3</td>
                                <td><span class="category">Eletrônica</span></td>
                                <td>Armário A3 - Prat. 2</td>
                                <td>15 un.</td>
                                <td>15 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Robótica" data-disponibilidade="Disponível">
                                <td>MAT-002</td>
                                <td class="material-name">Kit LEGO Mindstorms EV3</td>
                                <td><span class="category">Robótica</span></td>
                                <td>Armário B1 - Prat. 1</td>
                                <td>5 un.</td>
                                <td>5 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Sensores" data-disponibilidade="Disponível">
                                <td>MAT-003</td>
                                <td class="material-name">Sensor Ultrassônico HC-SR04</td>
                                <td><span class="category">Sensores</span></td>
                                <td>Armário A3 - Prat. 4</td>
                                <td>32 un.</td>
                                <td>32 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Ferramentas" data-disponibilidade="Disponível">
                                <td>MAT-004</td>
                                <td class="material-name">Multímetro Digital</td>
                                <td><span class="category">Ferramentas</span></td>
                                <td>Bancada Principal</td>
                                <td>3 un.</td>
                                <td>3 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Processamento" data-disponibilidade="Disponível">
                                <td>MAT-005</td>
                                <td class="material-name">Raspberry Pi 4 Model B</td>
                                <td><span class="category">Processamento</span></td>
                                <td>Armário A1 - Prat. 1</td>
                                <td>8 un.</td>
                                <td>8 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Ferramentas" data-disponibilidade="Disponível">
                                <td>MAT-006</td>
                                <td class="material-name">Ferro de Solda 60W</td>
                                <td><span class="category">Ferramentas</span></td>
                                <td>Bancada de Solda</td>
                                <td>6 un.</td>
                                <td>6 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Mecânica" data-disponibilidade="Em uso">
                                <td>MAT-007</td>
                                <td class="material-name">Motor DC com Caixa de Redução</td>
                                <td><span class="category">Mecânica</span></td>
                                <td>Armário C2 - Prat. 3</td>
                                <td>12 un.</td>
                                <td>0 un.</td>
                                <td><span class="status in-use">Em uso</span></td>
                            </tr>

                            <tr data-categoria="Eletrônica" data-disponibilidade="Disponível">
                                <td>MAT-008</td>
                                <td class="material-name">Protoboard 830 pontos</td>
                                <td><span class="category">Eletrônica</span></td>
                                <td>Armário A2 - Prat. 2</td>
                                <td>20 un.</td>
                                <td>20 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Eletrônica" data-disponibilidade="Disponível">
                                <td>MAT-009</td>
                                <td class="material-name">Kit de Resistores</td>
                                <td><span class="category">Eletrônica</span></td>
                                <td>Gaveteiro E1 - Gav. 4</td>
                                <td>10 kits</td>
                                <td>10 kits</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Sensores" data-disponibilidade="Disponível">
                                <td>MAT-010</td>
                                <td class="material-name">Sensor de Linha Infravermelho</td>
                                <td><span class="category">Sensores</span></td>
                                <td>Armário A3 - Prat. 3</td>
                                <td>18 un.</td>
                                <td>18 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Robótica" data-disponibilidade="Disponível">
                                <td>MAT-011</td>
                                <td class="material-name">Chassi para Robô Móvel</td>
                                <td><span class="category">Robótica</span></td>
                                <td>Armário B2 - Prat. 2</td>
                                <td>7 un.</td>
                                <td>7 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>

                            <tr data-categoria="Mecânica" data-disponibilidade="Disponível">
                                <td>MAT-012</td>
                                <td class="material-name">Micro Servo Motor SG90</td>
                                <td><span class="category">Mecânica</span></td>
                                <td>Armário C1 - Prat. 1</td>
                                <td>25 un.</td>
                                <td>25 un.</td>
                                <td><span class="status available">Disponível</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="semResultados" class="empty-state d-none">
                        Nenhum material encontrado.
                    </div>
                </div>

                <div class="table-footer">
                    <span id="contadorMateriais">Exibindo 12 materiais</span>
                    <span>Dados demonstrativos</span>
                </div>
            </div>

            <p class="demo-notice">
                Os materiais e as quantidades são fictícios e servem apenas para a prototipação.
            </p>

        </section>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('materiais.js') }}"></script>

</body>
</html>