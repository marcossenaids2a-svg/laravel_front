<?php

namespace App\Http\Middleware;

use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class EnsureUsuarioAutenticado
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('usuario_id')) {
            try {
                $id = Crypt::decryptString((string) $request->cookie('remember_usuario'));
                $usuario = Usuario::whereKey($id)->where('ativo', true)->first();
                if ($usuario) {
                    $request->session()->put(['usuario_id' => $usuario->id, 'usuario_nome' => $usuario->nome, 'usuario_tipo' => $usuario->tipo]);
                }
            } catch (\Throwable) {
                // Cookie ausente, expirado ou inválido: exige autenticação normal.
            }
        }

        if (! $request->session()->has('usuario_id')) {
            return redirect()->route('login')->with('status', 'Entre para acessar o sistema.');
        }

        return $next($request);
    }
}
