<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Robótica LMT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
</head>
<body>

<div class="login-container">

    <section class="login-banner">
        <div class="banner-content">
            <span class="brand-tag">SESI • EDUCAÇÃO</span>
            <h1>Robótica <span>LMT</span></h1>
            <p>
                Sistema de gerenciamento de materiais da Robótica
                e do Laboratório de Matemática e Tecnologia.
            </p>
        </div>
    </section>

    <section class="login-area">
        <div class="login-card">

            <div class="brand-mobile">ROBÓTICA <span>LMT</span></div>

            <h2>Bem-vindo!</h2>
            <p class="subtitle">Entre para acessar o sistema.</p>

            @if (session('erro'))
                <div class="alert alert-danger">
                    {{ session('erro') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    Confira o e-mail e a senha informados.
                </div>
            @endif

            <form action="{{ route('login.entrar') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="admin@sesi.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>

                    <div class="password-field">
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            class="form-control"
                            placeholder="Digite sua senha"
                            required
                        >

                        <button
                            type="button"
                            id="toggleSenha"
                            aria-label="Mostrar senha"
                        >
                            Mostrar
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    Entrar no sistema
                </button>
            </form>

            <p class="login-footer">
                Robótica LMT · SESI
            </p>

        </div>
    </section>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('login.js') }}"></script>

</body>
</html>