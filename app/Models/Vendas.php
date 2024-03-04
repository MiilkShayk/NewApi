<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_entrega', 'status_pagamento', 'cliente_id', 'produto_id', 'user_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produtos::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
