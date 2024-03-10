<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosVendas extends Model
{
    use HasFactory;
    protected $table = 'produtos_vendas';
    protected $fillable = ['venda_id', 'produto_id'];
    public function venda()
    {
        return $this->belongsTo(Vendas::class, 'venda_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }
}
