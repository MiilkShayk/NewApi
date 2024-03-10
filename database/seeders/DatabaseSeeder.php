<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categorias;
use App\Models\Clientes;
use App\Models\Produtos;
use App\Models\User;
use App\Models\Vendas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categorias::create([
            'nome' => 'categoria 1',
        ]);
        Categorias::create([
            'nome' => 'categoria 2',
        ]);
        Categorias::create([
            'nome' => 'categoria 3 ',
        ]);
        Categorias::create([
            'nome' => 'categoria 4',
        ]);
        Categorias::create([
            'nome' => 'categoria 5',
        ]);
        Produtos::create([
            'nome' => 'Produto 1',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 1
        ]);
        User::create([
            'name' => 'Adriano',
            'email' => 'adriano123@gmail.com',
            'password'  => bcrypt('123'),
        ]);
        Clientes::create([
            'nome' => 'Thiago Finch',
            'endereco' => 'Rua das Flores, nº 69',
            'telefone' => '1234432',
            'celular' => '(11)99232122',
            'facebook' => 'facebook.com/ArakisMuhadib',
            'google_maps' => 'URL_GOOGLEMAPS',
        ]);

        Vendas::create([
            'cliente_id' => 1,
            'produto_id' => 2,
            'metodo_pagamento' => 'dinheiro',
            'status_entrega' => 0,
            'status_pagamento' => 0,
            'user_id' => 2
        ]);
    }
}
