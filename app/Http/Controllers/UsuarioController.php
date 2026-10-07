<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuario.create');
    }

    public function salvar_usuario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'tipo' => 'required',
        ]);
        try {
            $usuario = new Usuario;
            $usuario->nome = $request->input('nome');
            $usuario->email = $request->input('email');
          
            $usuario->senha = Hash::make($request->input('senha'));
            $usuario->tipo = $request->input('tipo');
            $usuario->save();

            return response()->json(['message' => 'Usuário criado com sucesso!', 'erro' => 'n'], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao criar usuário: '.$th->getMessage(), 'erro' => 's'], 500);
        }
    }

    public function ver_usuario(Request $request){
        $usuario = Usuario::find($request->id);
        if($usuario){
            return response()->json(['usuario' => $usuario, 'erro' => 'n'], 200);
        }else{
            return response()->json(['message' => 'Usuário não encontrado', 'erro' => 's'], 500);
        }
    }

    public function listar_usuarios(Request $request){
        $usuarios = Usuario::all();
        return response()->json(['usuarios' => $usuarios, 'erro' => 'n'], 200);
    }

    public function listar_usuarios_simples(Request $request){
        $usuarios = Usuario::select( 'nome', 'email')->get();
        return response()->json(['usuarios' => $usuarios, 'erro' => 'n'], 200);
    }

    public function alterar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:usuarios,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'senha' => 'required|string|min:6',
            'tipo' => 'required',
        ]);
        try {
            $usuario = Usuario::find($request->input('id'));
            
            // Correção da lógica de verificação de e-mail duplicado
            if ($usuario->email != $request->input('email')) {
                $usuario_email = Usuario::where('email', $request->input('email'))->first();
                if ($usuario_email) {
                    return response()->json(['message' => 'Erro ao atualizar usuário: Email já cadastrado', 'erro' => 's'], 500);
                }
            }
            
            $usuario->nome = $request->input('nome');
            $usuario->email = $request->input('email');
          
            $usuario->senha = Hash::make($request->input('senha'));
            $usuario->tipo = $request->input('tipo');
            $usuario->save();

            return response()->json(['message' => 'Usuário atualizado com sucesso!', 'erro' => 'n'], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao atualizar usuário: '.$th->getMessage(), 'erro' => 's'], 500);
        }
    }

    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:usuarios,id',
        ]);
        try {
            $usuario = Usuario::find($request->input('id'));
            $usuario->delete();

            return response()->json(['message' => 'Usuário deletado com sucesso!', 'erro' => 'n'], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao deletar usuário: '.$th->getMessage(), 'erro' => 's'], 500);
        }
    }
}
