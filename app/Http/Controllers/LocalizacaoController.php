<?php

namespace App\Http\Controllers;

use App\Models\Localizacao;
use Illuminate\Http\Request;

class LocalizacaoController extends Controller
{
    // LISTAR
    public function index()
    {
        return response()->json(
            Localizacao::all()
        );
    }

    // CONSULTAR POR ID
    public function show($id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response()->json([
                'mensagem' => 'Localização não encontrada.'
            ], 404);
        }

        return response()->json($localizacao);
    }

    // CADASTRAR
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255'
        ]);

        $localizacao = Localizacao::create($dados);

        return response()->json([
            'mensagem' => 'Localização cadastrada!',
            'localizacao' => $localizacao
        ], 201);
    }

    // EDITAR
    public function update(Request $request, $id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response()->json([
                'mensagem' => 'Localização não encontrada.'
            ], 404);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255'
        ]);

        $localizacao->update($dados);

        return response()->json([
            'mensagem' => 'Localização atualizada!',
            'localizacao' => $localizacao
        ]);
    }

    // EXCLUIR
    public function destroy($id)
    {
        $localizacao = Localizacao::find($id);

        if (!$localizacao) {
            return response()->json([
                'mensagem' => 'Localização não encontrada.'
            ], 404);
        }

        $localizacao->delete();

        return response()->json([
            'mensagem' => 'Localização excluída!'
        ]);
    }
}
