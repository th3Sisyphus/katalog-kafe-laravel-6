<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class VisitorController extends Controller
{
    //
    public function home(Request $request){
        // Mulai Query
        $query = Produk::query();
        $keyword = $request->search;
        
        if ($keyword){
            $query->where('nama_menu', 'LIKE', '%' . $keyword . '%');
        }
        
        $produk = $query->orderBy('id_menu','desc')->get();

        return view('visitor.searchmenu', [
            'produk' => $produk, 
            'key' => 'home',
            'search' => $request->search // Kirim kata kunci agar tetap ada di input box
        ]);
    }
}
