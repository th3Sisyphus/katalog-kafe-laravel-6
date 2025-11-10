<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Produk;

class PageController extends Controller
{
    public function home(){
        $produk = Produk::orderBy('id_menu','desc')->get();
        return view('home', ['produk' => $produk]);
    }
    public function addmenu(){
        return view('addmenu');
    }
    public function saveMenu(Request $request){
        // Validasi file gambar (maks 2MB) dan tipe yang diizinkan
        $request->validate([
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max in KB
        ]);

        if($request->hasFile('gambar_produk')){
            $file_name=time().'_'.$request->file('gambar_produk')->getClientOriginalName();
            $file_path=$request->file('gambar_produk')->storeAs('images',$file_name,'public');
        }else{
            $file_path='images/noImage.jpg';
        }

        Produk::create([
            'nama_menu' => $request->input('nama_menu'),
            'harga_produk' => $request->input('harga_produk'),
            'stok' => $request->input('stok'),
            'diskon' => $request->input('diskon'),
            'kategori' => $request->input('kategori'),
            'gambar_produk' => $file_path,
        ]);
        return redirect('/')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editMenu($id){
        $produk = Produk::find($id);
        return view('editmenu', ['produk' => $produk]);
    }

    public function updateMenu(Request $request, $id){
        $produk = Produk::find($id);
        // Validasi file gambar (maks 2MB) dan tipe yang diizinkan
        $request->validate([
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max in KB
        ]);

        if($request->hasFile('gambar_produk')){
            $file_name=time().'_'.$request->file('gambar_produk')->getClientOriginalName();
            $file_path=$request->file('gambar_produk')->storeAs('images',$file_name,'public');
        }else{
            $file_path=$produk->gambar_produk;
        }

        $produk->update([
            'nama_menu' => $request->input('nama_menu'),
            'harga_produk' => $request->input('harga_produk'),
            'stok' => $request->input('stok'),
            'diskon' => $request->input('diskon'),
            'kategori' => $request->input('kategori'),
            'gambar_produk' => $file_path,
        ]);
        return redirect('/')->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteMenu($id){
        $produk = Produk::find($id);
        if ($produk->gambar_produk && $produk->gambar_produk != 'images/noImage.jpg') {
            Storage::disk('public')->delete($produk->gambar_produk);
        }
        $produk->delete();
        return redirect('/')->with('success', 'Produk berhasil dihapus.');
    }
}
