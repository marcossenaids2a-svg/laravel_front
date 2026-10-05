<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\ItemEmprestimo;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $recentes = Emprestimo::orderByDesc('data_emprestimo')->limit(6)->get();
        foreach ($recentes as $emprestimo) {
            $emprestimo->usuario = Usuario::find($emprestimo->id_usuario);
            $emprestimo->item = ItemEmprestimo::where('id_emprestimo', $emprestimo->id)->first();
            $emprestimo->material = $emprestimo->item ? Material::find($emprestimo->item->id_material) : null;
        }
        $movimentacoes = collect(range(6, 0))->map(function ($dias) {
            $data = now()->subDays($dias);
            return ['dia' => $data->translatedFormat('D'), 'total' => Emprestimo::whereDate('data_emprestimo', $data->toDateString())->count()];
        });

        return view('dashboard', [
            'totalMateriais' => Material::count(),
            'emprestimosAtivos' => Emprestimo::where('status', 'ativo')->count(),
            'pedidosPendentes' => Schema::hasTable('pedidos') ? Pedido::where('status', 'pendente')->count() : 0,
            'materiaisManutencao' => Material::where('estado', 'like', '%manuten%')->count(),
            'recentes' => $recentes,
            'movimentacoes' => $movimentacoes,
            'usuarioNome' => session('usuario_nome', 'Usuário'),
        ]);
    }
}
