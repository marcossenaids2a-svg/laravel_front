<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\ItemEmprestimo;
use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EmprestimoController extends Controller
{
    public function index(Request $request)
    {
        $query = Emprestimo::query();
        if ($request->filled('status')) $query->where('status', $request->input('status'));
        if ($request->filled('busca')) {
            $termo = '%'.$request->input('busca').'%';
            $usuarios = Usuario::where('nome', 'like', $termo)->pluck('id');
            $emprestimosPorMaterial = ItemEmprestimo::whereIn('id_material', Material::where('nome', 'like', $termo)->pluck('id'))->pluck('id_emprestimo');
            $query->where(fn ($q) => $q->whereIn('id_usuario', $usuarios)->orWhereIn('id', $emprestimosPorMaterial));
        }
        $emprestimos = $query->orderByDesc('data_emprestimo')->paginate(15)->withQueryString();

        foreach ($emprestimos as $emprestimo) {
            $emprestimo->usuario = Usuario::find($emprestimo->id_usuario);
            $emprestimo->item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
            $emprestimo->material = $emprestimo->item ? Material::find($emprestimo->item->id_material) : null;
        }

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        return view('emprestimos.create', $this->opcoes());
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);
        DB::transaction(function () use ($dados) {
            $material = Material::whereKey($dados['id_material'])->lockForUpdate()->firstOrFail();
            if ($material->quantidade_disponivel < $dados['quantidade']) {
                throw ValidationException::withMessages(['quantidade' => 'Estoque disponível insuficiente.']);
            }
            $emprestimo = Emprestimo::create([
                'id_usuario' => $dados['id_usuario'],
                'data_emprestimo' => $dados['data_emprestimo'],
                'data_devolucao' => $dados['data_devolucao'] ?? null,
                'status' => $dados['status'] ?? 'ativo',
                'observacao' => $dados['observacao'] ?? null,
            ]);
            ItemEmprestimo::create(['id_emprestimo' => $emprestimo->id, 'id_material' => $material->id, 'quantidade' => $dados['quantidade']]);
            if (strtolower($emprestimo->status) !== 'devolvido') $material->decrement('quantidade_disponivel', $dados['quantidade']);
        });

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo cadastrado com sucesso.');
    }

    public function show(Emprestimo $emprestimo)
    {
        $emprestimo->usuario = Usuario::find($emprestimo->id_usuario);
        $emprestimo->item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
        $emprestimo->material = $emprestimo->item ? Material::find($emprestimo->item->id_material) : null;

        return view('emprestimos.show', compact('emprestimo'));
    }

    public function edit(Emprestimo $emprestimo)
    {
        $emprestimo->item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
        return view('emprestimos.edit', ['usuarios' => Usuario::where('ativo', true)->orderBy('nome')->get(), 'materiais' => Material::orderBy('nome')->get(), 'emprestimo' => $emprestimo]);
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $dados = $this->validar($request, $emprestimo);
        DB::transaction(function () use ($dados, $emprestimo) {
            $item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
            $materialAnterior = $item ? Material::whereKey($item->id_material)->lockForUpdate()->first() : null;
            $materialNovo = Material::whereKey($dados['id_material'])->lockForUpdate()->firstOrFail();
            if ($materialAnterior && strtolower($emprestimo->status) !== 'devolvido') $materialAnterior->increment('quantidade_disponivel', $item->quantidade);
            if ($materialNovo->quantidade_disponivel < $dados['quantidade'] && strtolower($dados['status'] ?? 'ativo') !== 'devolvido') {
                throw ValidationException::withMessages(['quantidade' => 'Estoque disponível insuficiente.']);
            }
            $novoStatusAtivo = strtolower($dados['status'] ?? 'ativo') !== 'devolvido';
            $emprestimo->update(['id_usuario' => $dados['id_usuario'], 'data_emprestimo' => $dados['data_emprestimo'], 'data_devolucao' => $dados['data_devolucao'] ?? null, 'status' => $dados['status'], 'observacao' => $dados['observacao'] ?? null]);
            if ($item) $item->update(['id_material' => $materialNovo->id, 'quantidade' => $dados['quantidade']]);
            else ItemEmprestimo::create(['id_emprestimo' => $emprestimo->id, 'id_material' => $materialNovo->id, 'quantidade' => $dados['quantidade']]);
            if ($novoStatusAtivo) $materialNovo->decrement('quantidade_disponivel', $dados['quantidade']);
        });

        return redirect()->route('emprestimos.show', $emprestimo)->with('success', 'Empréstimo atualizado com sucesso.');
    }

    public function destroy(Emprestimo $emprestimo)
    {
        DB::transaction(function () use ($emprestimo) {
            $item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
            if ($item && strtolower($emprestimo->status) !== 'devolvido') Material::whereKey($item->id_material)->increment('quantidade_disponivel', $item->quantidade);
            ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->delete();
            $emprestimo->delete();
        });

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo excluído com sucesso.');
    }

    private function validar(Request $request, ?Emprestimo $emprestimo = null): array
    {
        return $request->validate([
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id'], 'id_material' => ['required', 'integer', 'exists:materiais,id'],
            'quantidade' => ['required', 'integer', 'min:1'], 'data_emprestimo' => ['required', 'date'],
            'data_devolucao' => ['nullable', 'date', 'after_or_equal:data_emprestimo'],
            'status' => ['required', 'in:ativo,devolvido,atrasado'], 'observacao' => ['nullable', 'string'],
        ]);
    }

    private function opcoes(): array
    {
        return ['usuarios' => Usuario::where('ativo', true)->orderBy('nome')->get(), 'materiais' => Material::where('quantidade_disponivel', '>', 0)->orderBy('nome')->get()];
    }
}
