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
        Produtos::create([
            'nome' => 'Produto 2',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 2
        ]);
        Produtos::create([
            'nome' => 'Produto 3',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 1
        ]);
        Produtos::create([
            'nome' => 'Produto 4',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 3
        ]);
        Produtos::create([
            'nome' => 'Produto 5',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 2
        ]);
        Produtos::create([
            'nome' => 'Produto 6',
            'imagem' => 'URL_IMAGEM',
            'valor_compra' => 10.99,
            'valor_venda' => 10.99,
            'categoria_id' => 4
        ]);
        User::create([
            'name' => 'Adriano',
            'email' => 'adriano123@gmail.com',
            'password'  => bcrypt('123'),
        ]);
        User::create([
            'name' => 'Roberto',
            'email' => 'roberto123@gmail.com',
            'password' =>  bcrypt('123123')
        ]);
        User::create([
            'name' => 'Jéssica',
            'email' => 'jessica123@gmail.com',
            'password' => bcrypt('321')
        ]);
        User::create([
            'name' => 'Alfredo',
            'email' => 'alfredo123@gmail.com',
            'password' => bcrypt('555')
        ]);
        Clientes::create([
            'nome' => 'Thiago Finch',
            'endereco' => 'Rua das Flores, nº 69',
            'telefone' => '1234432',
            'celular' => '(11)99232122',
            'facebook' => 'facebook.com/ArakisMuhadib',
            'google_maps' => 'URL_GOOGLEMAPS',
        ]);
        Clientes::create([
            'nome' => 'Arakis Finch',
            'endereco' => 'Rua das Flores, nº 39',
            'telefone' => '1234432',
            'celular' => '(11)322222',
            'facebook' => 'facebook.com/ArakisMuhadib',
            'google_maps' => 'URL_GOOGLEMAPS',
        ]);
        Clientes::create([
            'nome' => 'Bruno Ports',
            'endereco' => 'Rua das , nº 69',
            'telefone' => '1234432',
            'celular' => '(11)99232122',
            'facebook' => 'facebook.com/ArakisMuhadib',
            'google_maps' => 'URL_GOOGLEMAPS',
        ]);
        Vendas::create([
            'cliente_id' => 1,
            'produto_id' => 2,
            'status_entrega' => 0,
            'status_pagamento' => 0,
            'user_id' => 2
        ]);
        Vendas::create([
            'cliente_id' => 1,
            'produto_id' => 3,
            'status_entrega' => 1,
            'status_pagamento' => 1,
            'user_id' => 2
        ]);
        Vendas::create([
            'cliente_id' => 2,
            'produto_id' => 4,
            'status_entrega' => 1,
            'status_pagamento' => 1,
            'user_id' => 3
        ]);
    }
}
