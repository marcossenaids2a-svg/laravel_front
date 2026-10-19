<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\PedidoController;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedidos');
    }

    // Listar todos os pedidos
    public function listar_pedidos()
    {
        return response()->json(Pedido::all());
    }

    // Consultar pedido por ID
    public function ver_pedido($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'mensagem' => 'Pedido não encontrado.'
            ], 404);
        }

        return response()->json($pedido);
    }

    // Cadastrar pedido
    public function cadastrar_pedido(Request $request)
    {
        $dados = $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id',
            'id_material' => 'required|integer|exists:materiais,id',
            'data_pedido' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $pedido = Pedido::create($dados);

        return response()->json([
            'mensagem' => 'Pedido cadastrado com sucesso!',
            'pedido' => $pedido
        ], 201);
    }

    // Alterar pedido
    public function alterar_pedido(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'mensagem' => 'Pedido não encontrado.'
            ], 404);
        }

        $dados = $request->validate([
            'id_usuario' => 'sometimes|required|integer|exists:usuarios,id',
            'id_material' => 'sometimes|required|integer|exists:materiais,id',
            'data_pedido' => 'sometimes|required|date',
            'status' => 'sometimes|required|string|max:255',
        ]);

        $pedido->update($dados);

        return response()->json([
            'mensagem' => 'Pedido alterado com sucesso!',
            'pedido' => $pedido
        ]);
    }

    // Excluir pedido
    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'mensagem' => 'Pedido não encontrado.'
            ], 404);
        }

        try {
            $pedido->delete();

            return response()->json([
                'mensagem' => 'Pedido deletado com sucesso!'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'mensagem' => 'Não foi possível excluir o pedido, pois existem registros relacionados.'
            ], 409);
        }
    }
}
