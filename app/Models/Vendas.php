<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;
    protected $fillable = [
        'metodo_pagamento',
        'status_entrega',
        'status_pagamento',
        'cliente_id',
        'user_id',
        'valor_total',
        'parcelado'
    ];
    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produtos::class, 'produtos_vendas', 'venda_id', 'produto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
