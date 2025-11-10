<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $primaryKey = 'id_menu';
    protected $table='produk';
    protected $fillable = [
        'nama_menu',
        'harga_produk',
        'stok',
        'diskon',
        'kategori',
        'gambar_produk',
    ];
}
