<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function index()
    {
        if (session()->has('usuario_id')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string'],
        ]);

        $usuario = Usuario::where('email', $dados['email'])->where('ativo', true)->first();

        if (! $usuario || ! $this->senhaValida($dados['senha'], $usuario->senha)) {
            return back()->withErrors(['email' => 'E-mail ou senha inválidos.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put([
            'usuario_id' => $usuario->id,
            'usuario_nome' => $usuario->nome,
            'usuario_tipo' => $usuario->tipo,
        ]);

        $response = redirect()->intended(route('dashboard'));
        if ($request->boolean('lembrar')) {
            $response->cookie(cookie()->forever('remember_usuario', Crypt::encryptString((string) $usuario->id)));
        } else {
            $response->withCookie(cookie()->forget('remember_usuario'));
        }

        return $response;
    }

    private function senhaValida(string $senha, string $armazenada): bool
    {
        try {
            if (Hash::check($senha, $armazenada)) {
                return true;
            }
        } catch (\Throwable) {
            // Senhas legadas podem não ter sido armazenadas por um hasher do Laravel.
        }

        // Compatibilidade com cadastros legados em texto simples.
        return ! str_starts_with($armazenada, '$2y$') && ! str_starts_with($armazenada, '$argon')
            && hash_equals($armazenada, $senha);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withCookie(cookie()->forget('remember_usuario'));
    }
}
