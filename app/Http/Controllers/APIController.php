<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class APIController extends Controller
{
    //
    public function produk(){
        $produk = Produk::orderBy('id_menu','desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data produk retrieved successfully',
            'length' => count($produk), 
            'data' => $produk
        ]);
    }
}
