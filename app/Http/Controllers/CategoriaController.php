<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // LISTAR TODAS AS CATEGORIAS
    public function index()
    {
        return response()->json(Categoria::all());
    }

    // CONSULTAR UMA CATEGORIA PELO ID
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'mensagem' => 'Categoria não encontrada.'
            ], 404);
        }

        return response()->json($categoria);
    }

    // CADASTRAR CATEGORIA
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255'
        ]);

        $categoria = Categoria::create($dados);

        return response()->json([
            'mensagem' => 'Categoria cadastrada com sucesso!',
            'categoria' => $categoria
        ], 201);
    }

    // EDITAR CATEGORIA
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'mensagem' => 'Categoria não encontrada.'
            ], 404);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255'
        ]);

        $categoria->update($dados);

        return response()->json([
            'mensagem' => 'Categoria atualizada com sucesso!',
            'categoria' => $categoria
        ]);
    }

    // EXCLUIR CATEGORIA
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'mensagem' => 'Categoria não encontrada.'
            ], 404);
        }

        try {
            $categoria->delete();

            return response()->json([
                'mensagem' => 'Categoria excluída com sucesso!'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'mensagem' => 'Não foi possível excluir a categoria. Verifique se existem materiais vinculados a ela.'
            ], 409);
        }
    }
}
