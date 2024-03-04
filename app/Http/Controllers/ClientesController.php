<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    protected $clienteservice;

    public function __construct(ClienteService $clienteservice)
    {
        $this->clienteservice = $clienteservice;
    }
    public function index()
    {
        try {
            $clientes = $this->clienteservice->listarClientes();
            return response()->json($clientes, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $cliente = $this->clienteservice->buscarCliente($id);
            if ($cliente) {
                return response()->json($cliente, 200);
            } else {
                throw new \Exception('Cliente não encontrado');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'endereco' => 'required|string',
            'telefone' => 'required|string',
            'celular' => 'required|string',
            'facebook' => 'required|string',
            'google_maps' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $cliente = $this->clienteservice->criarCliente($request->all());
            return response()->json($cliente, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string',
                'endereco' => 'required|string',
                'telefone' => 'required|numeric|min:0',
                'celular' => 'required|numeric|min:0',
                'facebook' => 'required|string',
                'google_maps' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $dados = $request->only(['nome', 'endereco', 'telefone', 'celular', 'facebook', 'google_maps']);
            $cliente = $this->clienteservice->atualizarCliente($id, $dados);

            return response()->json(['message' => 'Cliente atualizado com sucesso.', 'data' => $cliente], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $this->clienteservice->deletarCliente($id);

            return response()->json(['message' => 'Cliente deletado com sucesso.'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
