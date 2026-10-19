<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MaterialController extends Controller
{
    // ABRIR A PÁGINA DE MATERIAIS
    public function index()
    {
        return view('materiais');
    }

    // LISTAR TODOS OS MATERIAIS
    public function listar()
    {
        return response()->json(Material::all());
    }

    // CONSULTAR MATERIAL POR ID
    public function show($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'mensagem' => 'Material não encontrado.'
            ], 404);
        }

        return response()->json($material);
    }

    // CADASTRAR MATERIAL
    public function store(Request $request)
    {
        $dados = $request->validate([
            'codigo' => 'required|string|max:255|unique:materiais,codigo',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'id_categoria' => 'required|integer|exists:categorias,id',
            'id_localizacao' => 'required|integer|exists:localizacoes,id',
            'quantidade' => 'required|integer|min:0',
            'quantidade_disponivel' => 'required|integer|min:0|lte:quantidade',
            'quantidade_minima' => 'required|integer|min:0',
            'estado' => 'nullable|string|max:255',
            'tipo_material' => 'nullable|string|max:255',
        ]);

        $material = Material::create($dados);

        return response()->json([
            'mensagem' => 'Material cadastrado com sucesso!',
            'material' => $material
        ], 201);
    }

    // EDITAR MATERIAL
    public function update(Request $request, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'mensagem' => 'Material não encontrado.'
            ], 404);
        }

        $dados = $request->validate([
            'codigo' => 'sometimes|required|string|max:255|unique:materiais,codigo,' . $id,
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|nullable|string',
            'id_categoria' => 'sometimes|required|integer|exists:categorias,id',
            'id_localizacao' => 'sometimes|required|integer|exists:localizacoes,id',
            'quantidade' => 'sometimes|required|integer|min:0',
            'quantidade_disponivel' => 'sometimes|required|integer|min:0|lte:quantidade',
            'quantidade_minima' => 'sometimes|required|integer|min:0',
            'estado' => 'sometimes|nullable|string|max:255',
            'tipo_material' => 'sometimes|nullable|string|max:255',
        ]);

        $material->update($dados);

        return response()->json([
            'mensagem' => 'Material atualizado com sucesso!',
            'material' => $material->fresh()
        ]);
    }

    // EXCLUIR MATERIAL
    public function destroy($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'mensagem' => 'Material não encontrado.'
            ], 404);
        }

        try {
            $material->delete();

            return response()->json([
                'mensagem' => 'Material excluído com sucesso!'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'mensagem' => 'Não foi possível excluir o material. Verifique se existem registros vinculados a ele.'
            ], 409);
        }
    }
}
