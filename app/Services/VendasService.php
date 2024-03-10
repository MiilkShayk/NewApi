<?php

namespace App\Services;

use App\Models\Parcelas;
use App\Models\Produtos;
use App\Models\ProdutosVendas;
use App\Models\Vendas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VendasService
{
    public function criarVenda(array $dados)
    {
        $regras = [
            'metodo_pagamento' => 'required|string',
            'status_entrega' => 'required|boolean',
            'status_pagamento' => 'required|integer',
            'cliente_id' => 'required|exists:clientes,id',
            'produtos' => 'required|array|min:1',
            'produtos.*.id' => 'required|exists:produtos,id',
            'parcelas' => 'nullable|integer|min:0',

        ];

        $mensagens = [
            'cliente_id.exists' => 'O cliente selecionado não existe.',
            'produtos.required' => 'Selecione pelo menos um produto para a venda.',
            'produtos.min' => 'Selecione pelo menos um produto para a venda.',
            'produtos.*.id.exists' => 'Um dos produtos selecionados não existe.',
            'parcelas.min' => 'O número de parcelas deve ser maior ou igual a zero.',
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            throw new \InvalidArgumentException($validador->errors()->first());
        }

        $usuarioAutenticado = Auth::user();

        $valorTotal = 0;
        foreach ($dados['produtos'] as $produto) {
            $produtoSelecionado = Produtos::find($produto['id']);
            $valorTotal += $produtoSelecionado->valor_venda;
        }

        $entrada = isset($dados['entrada']) ? $dados['entrada'] : 0;

        if ($entrada > $valorTotal) {
            throw new \InvalidArgumentException('O valor de entrada não pode ser maior que o valor total da venda.');
        }

        $valorTotal -= $entrada;

        $parcelado = isset($dados['parcelas']) && $dados['parcelas'] > 0;

        $venda = new Vendas();
        $venda->metodo_pagamento = $dados['metodo_pagamento'];
        $venda->status_entrega = $dados['status_entrega'];
        $venda->status_pagamento = $dados['status_pagamento'];
        $venda->cliente_id = $dados['cliente_id'];
        $venda->user_id = $usuarioAutenticado->id;
        $venda->valor_total = $valorTotal;
        $venda->parcelado = $parcelado;
        $venda->save();

        foreach ($dados['produtos'] as $produto) {
            ProdutosVendas::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto['id']
            ]);
        }

        if ($parcelado) {
            $numeroParcelas = $dados['parcelas'];
            $valorParcela = $valorTotal / $numeroParcelas;

            $dataVencimento = now()->addMonth(); // Próximo mês

            if ($entrada > 0) {
                $dataVencimento = $dataVencimento->addMonth();
            }

            for ($i = 0; $i < $numeroParcelas; $i++) {
                $parcela = new Parcelas();
                $parcela->venda_id = $venda->id;
                $parcela->valor_parcela = $valorParcela;
                $parcela->vencimento = $dataVencimento->addMonths($i);
                $parcela->save();
            }
        }

        return $venda;
    }
    public function atualizarVenda(Vendas $venda, array $data)
    {
        $validator = Validator::make($data, [
            'status_entrega' => 'required|boolean',
            'status_pagamento' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $venda->update([
            'status_entrega' => $data['status_entrega'],
            'status_pagamento' => $data['status_pagamento'],
        ]);

        return $venda;
    }
    public function listarVendas()
    {
        return Vendas::with('cliente', 'user')->get();
    }
    public function buscarVenda($id)
    {
        return Vendas::findOrFail($id);
    }
}
