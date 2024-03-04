<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    protected $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }
    public function index()
    {
        try {
            $produtos = $this->produtoService->listarProdutos();
            return response()->json($produtos, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $produto = $this->produtoService->buscarProduto($id);
            if ($produto) {
                return response()->json($produto, 200);
            } else {
                throw new \Exception('Produto não encontrado');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'imagem' => 'required|string',
            'valor_compra' => 'required|numeric|min:0',
            'valor_venda' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $produto = $this->produtoService->criarProduto($request->all());
            return response()->json($produto, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string',
                'imagem' => 'required|string',
                'valor_compra' => 'required|numeric|min:0',
                'valor_venda' => 'required|numeric|min:0',
                'categoria_id' => 'required|exists:categorias,id'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $dados = $request->only(['nome', 'imagem', 'valor_compra', 'valor_venda', 'categoria_id']);
            $produto = $this->produtoService->atualizarProduto($id, $dados);

            return response()->json(['message' => 'Product updated successfully', 'data' => $produto], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $this->produtoService->deletarProduto($id);

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
