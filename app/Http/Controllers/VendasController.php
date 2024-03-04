<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Services\VendasService;

class VendasController extends Controller
{
    protected $vendaService;

    public function __construct(VendasService $vendaService)
    {
        $this->vendaService = $vendaService;
    }

    public function store(Request $request)
    {
        try {
            $venda = $this->vendaService->criarVenda($request->all());
            return response()->json($venda, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $vendas = $this->vendaService->listarVendas();
            return response()->json($vendas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $venda = $this->vendaService->buscarVenda($id);
    
            if ($venda) {
                $venda->load('cliente', 'produto', 'user');
    
                return response()->json($venda, 200);
            } else {
                throw new \Exception('Venda não encontrada');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, Vendas $venda)
    {
        try {
            $venda = $this->vendaService->atualizarVenda($venda, $request->all());
            return response()->json($venda, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
