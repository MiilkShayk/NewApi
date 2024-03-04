<?php

namespace App\Services;

use App\Models\Clientes;

class ClienteService
{
    public function listarClientes()
    {
        return Clientes::all();
    }
    public function buscarCliente($id)
    {
        return Clientes::find($id);
    }
    public function criarCliente(array $dados)
    {
        return Clientes::create($dados);
    }
    public function atualizarCliente($id, array $dados)
    {
        $clientes = Clientes::findOrFail($id);
        $clientes->update($dados);
        return $clientes;
    }
    public function deletarCliente($id)
    {
        $clientes = Clientes::findOrFail($id);
        $clientes->delete();

        return $clientes;
    }
}
