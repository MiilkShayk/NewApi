<?php

namespace App\Services;

use App\Models\Produtos;

class ProdutoService
{
    public function listarProdutos()
    {
        return Produtos::all();
    }
    public function buscarProduto($id)
    {
        return Produtos::find($id);
    }
    public function criarProduto(array $dados)
    {
        return Produtos::create($dados);
    }
    public function atualizarProduto($id, array $dados)
    {
        $produto = Produtos::findOrFail($id);
        $produto->update($dados);
        return $produto;
    }
    public function deletarProduto($id)
    {
        $produto = Produtos::findOrFail($id);
        $produto->delete();

        return $produto;
    }
    public function atualizarStatusPagamento($id, $pago)
    {
        $produto = Produtos::findOrFail($id);

        if ($pago) {
            $produto->status = 'pago';
        } else {
            $produto->status = 'aguardando pagamento';
        }

        $produto->save();

        return $produto;
    }
}
