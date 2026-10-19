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
        'tipo' => 'sometimes|string',
        'ativo' => 'sometimes|boolean',
    ]);

    try {
        $usuario = new Usuario();

        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->tipo = $request->input('tipo', 'usuario');
        $usuario->ativo = $request->input('ativo', true);

        $usuario->save();

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'usuario' => $usuario,
            'erro' => 'n'
        ], 201);

    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'Erro ao criar usuário.',
            'erro' => 's'
        ], 500);
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
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:usuarios,email,' . $request->input('id'),
            'senha' => 'sometimes|string|min:6',
            'tipo' => 'sometimes|string',
            'ativo' => 'sometimes|boolean',
        ]);

        try {
            $usuario = Usuario::find($request->input('id'));

            if ($request->has('nome')) {
                $usuario->nome = $request->input('nome');
            }
            if ($request->has('email')) {
                $usuario->email = $request->input('email');
            }
            if ($request->has('senha')) {
                $usuario->senha = Hash::make($request->input('senha'));
            }
            if ($request->has('tipo')) {
                $usuario->tipo = $request->input('tipo');
            }
            if ($request->has('ativo')) {
                $usuario->ativo = $request->input('ativo');
            }

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
