<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::query();
        if ($request->filled('status')) $query->where('status', $request->input('status'));
        if ($request->filled('busca')) {
            $termo = '%'.$request->input('busca').'%';
            $usuarios = Usuario::where('nome', 'like', $termo)->pluck('id');
            $pedidosComMaterial = ItemPedido::whereIn('id_material', Material::where('nome', 'like', $termo)->pluck('id'))->pluck('id_pedido');
            $query->where(fn ($q) => $q->whereIn('id_usuario', $usuarios)->orWhereIn('id', $pedidosComMaterial));
        }
        $pedidos = $query->orderByDesc('data_pedido')->paginate(15)->withQueryString();
        foreach ($pedidos as $pedido) {
            $pedido->usuario = Usuario::find($pedido->id_usuario);
            $pedido->item = ItemPedido::where('id_pedido', $pedido->id)->first();
            $pedido->material = $pedido->item ? Material::find($pedido->item->id_material) : null;
        }

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create', $this->opcoes());
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);
        DB::transaction(function () use ($dados) {
            $pedido = Pedido::create(['id_usuario' => $dados['id_usuario'], 'data_pedido' => $dados['data_pedido'], 'status' => 'pendente', 'observacao' => $dados['observacao'] ?? null]);
            ItemPedido::create(['id_pedido' => $pedido->id, 'id_material' => $dados['id_material'], 'quantidade' => $dados['quantidade']]);
        });

        return redirect()->route('pedidos.index')->with('success', 'Pedido registrado e encaminhado para análise.');
    }

    public function show(Pedido $pedido)
    {
        $pedido->usuario = Usuario::find($pedido->id_usuario);
        $pedido->item = ItemPedido::where('id_pedido', $pedido->id)->first();
        $pedido->material = $pedido->item ? Material::find($pedido->item->id_material) : null;

        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $pedido->item = ItemPedido::where('id_pedido', $pedido->id)->first();

        return view('pedidos.edit', $this->opcoes() + compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $dados = $this->validar($request, true);
        DB::transaction(function () use ($dados, $pedido) {
            if ($dados['status'] === 'aprovado') {
                $material = Material::whereKey($dados['id_material'])->firstOrFail();
                if ($material->quantidade_disponivel < $dados['quantidade']) {
                    throw ValidationException::withMessages(['status' => 'Estoque insuficiente: informe indisponibilidade ou ajuste a quantidade.']);
                }
            }
            $pedido->update(['id_usuario' => $dados['id_usuario'], 'data_pedido' => $dados['data_pedido'], 'status' => $dados['status'], 'observacao' => $dados['observacao'] ?? null]);
            $item = ItemPedido::where('id_pedido', $pedido->id)->first();
            if ($item) $item->update(['id_material' => $dados['id_material'], 'quantidade' => $dados['quantidade']]);
            else ItemPedido::create(['id_pedido' => $pedido->id, 'id_material' => $dados['id_material'], 'quantidade' => $dados['quantidade']]);
        });

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido)
    {
        ItemPedido::where('id_pedido', $pedido->id)->delete();
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }

    private function validar(Request $request, bool $atualizacao = false): array
    {
        $regras = ['id_usuario' => ['required', 'integer', 'exists:usuarios,id'], 'id_material' => ['required', 'integer', 'exists:materiais,id'], 'quantidade' => ['required', 'integer', 'min:1'], 'data_pedido' => ['required', 'date'], 'observacao' => ['nullable', 'string']];
        if ($atualizacao) $regras['status'] = ['required', 'in:pendente,aprovado,negado,concluido'];

        return $request->validate($regras);
    }

    private function opcoes(): array
    {
        return ['usuarios' => Usuario::where('ativo', true)->orderBy('nome')->get(), 'materiais' => Material::orderBy('nome')->get()];
    }
}
