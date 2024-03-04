<?php

namespace App\Services;

use App\Models\Vendas;

class VendasService
{
    public function criarVenda(array $data)
    {
        if (!isset($data['produto_id']) || !isset($data['cliente_id']) || !isset($data['user_id'])) {
            throw new \Exception('Dados incompletos para criar a venda');
        }
        return Vendas::create($data);
    }
    public function atualizarVenda(Vendas $venda, array $data)
    {
        if (!isset($data['status_entrega']) || !isset($data['status_pagamento'])) {
            throw new \Exception('Dados incompletos para atualizar a venda');
        }
        $venda->update($data);

        return $venda;
    }
    public function listarVendas()
    {
        return Vendas::with('cliente', 'produto', 'user')->get();
    }
    public function buscarVenda($id)
    {
        return Vendas::findOrFail($id);
    }
}
