<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprestimo;
use Illuminate\Database\QueryException;

class EmprestimoController extends Controller
{
    public function index()
    {
        return view('emprestimos');
    }

    // LISTAR EMPRÉSTIMOS
    public function listar_emprestimos()
    {
        return response()->json(Emprestimo::all());
    }

    // VER UM EMPRÉSTIMO
    public function ver_emprestimo($id)
    {
        $emprestimo = Emprestimo::find($id);

        if (!$emprestimo) {
            return response()->json([
                'mensagem' => 'Empréstimo não encontrado.'
            ], 404);
        }

        return response()->json($emprestimo);
    }

    // CADASTRAR EMPRÉSTIMO
    public function cadastrar_emprestimo(Request $request)
    {
        $dados = $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id',
            'id_material' => 'required|integer|exists:materiais,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date|after_or_equal:data_emprestimo',
            'status' => 'required|string|max:255',
        ]);

        $emprestimo = Emprestimo::create($dados);

        return response()->json([
            'mensagem' => 'Empréstimo cadastrado com sucesso!',
            'emprestimo' => $emprestimo
        ], 201);
    }

    // ALTERAR EMPRÉSTIMO
    public function alterar_emprestimo(Request $request, $id)
    {
        $emprestimo = Emprestimo::find($id);

        if (!$emprestimo) {
            return response()->json([
                'mensagem' => 'Empréstimo não encontrado.'
            ], 404);
        }

        $dados = $request->validate([
            'id_usuario' => 'sometimes|required|integer|exists:usuarios,id',
            'id_material' => 'sometimes|required|integer|exists:materiais,id',
            'data_emprestimo' => 'sometimes|required|date',
            'data_devolucao' => 'sometimes|nullable|date|after_or_equal:data_emprestimo',
            'status' => 'sometimes|required|string|max:255',
        ]);

        $emprestimo->update($dados);

        return response()->json([
            'mensagem' => 'Empréstimo alterado com sucesso!',
            'emprestimo' => $emprestimo->fresh()
        ]);
    }

    // DELETAR EMPRÉSTIMO
    public function deletar_emprestimo($id)
    {
        $emprestimo = Emprestimo::find($id);

        if (!$emprestimo) {
            return response()->json([
                'mensagem' => 'Empréstimo não encontrado.'
            ], 404);
        }

        try {
            $emprestimo->delete();

            return response()->json([
                'mensagem' => 'Empréstimo excluído com sucesso!'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'mensagem' => 'Não foi possível excluir. Existem registros vinculados a este empréstimo.'
            ], 409);
        }
    }
}
