<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query();
        if ($request->filled('busca')) {
            $term = $request->string('busca')->toString();
            $query->where(fn ($q) => $q->where('nome', 'like', "%{$term}%")->orWhere('codigo', 'like', "%{$term}%"));
        }
        if ($request->filled('estado')) $query->where('estado', $request->input('estado'));
        if ($request->filled('categoria')) $query->where('id_categoria', $request->input('categoria'));

        $materiais = $query->orderBy('nome')->paginate(15)->withQueryString();

        return view('materiais.index', [
            'materiais' => $materiais,
            'categorias' => $this->opcoes('categorias'),
            'localizacoes' => $this->opcoes('localizacoes'),
        ]);
    }

    public function create()
    {
        return view('materiais.create', ['material' => new Material, 'categorias' => $this->opcoes('categorias'), 'localizacoes' => $this->opcoes('localizacoes')]);
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);
        $dados['quantidade_disponivel'] = $dados['quantidade_disponivel'] ?? $dados['quantidade'];
        Material::create($dados);

        return redirect()->route('materiais.index')->with('success', 'Material cadastrado com sucesso.');
    }

    public function show(Material $material)
    {
        return view('materiais.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materiais.edit', ['material' => $material, 'categorias' => $this->opcoes('categorias'), 'localizacoes' => $this->opcoes('localizacoes')]);
    }

    public function update(Request $request, Material $material)
    {
        $material->update($this->validar($request, $material));

        return redirect()->route('materiais.show', $material)->with('success', 'Material atualizado com sucesso.');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materiais.index')->with('success', 'Material excluído com sucesso.');
    }

    private function validar(Request $request, ?Material $material = null): array
    {
        $codigoUnico = Rule::unique('materiais', 'codigo');
        if ($material) $codigoUnico->ignore($material->id);

        return $request->validate([
            'codigo' => ['required', 'string', 'max:100', $codigoUnico],
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'id_categoria' => ['nullable', 'integer'],
            'id_localizacao' => ['nullable', 'integer'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'quantidade_disponivel' => ['nullable', 'integer', 'min:0', 'lte:quantidade'],
            'quantidade_minima' => ['nullable', 'integer', 'min:0'],
            'estado' => ['required', 'string', 'max:50'],
            'tipo_material' => ['nullable', 'string', 'max:100'],
        ]);
    }

    private function opcoes(string $tabela)
    {
        return Schema::hasTable($tabela) ? DB::table($tabela)->orderBy('id')->get() : collect();
    }
}
