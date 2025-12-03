<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Produk;
use App\User;

class PageController extends Controller
{
    // Login Page
    public function loginPage(){
        return view('admin.login');
    }


    // Home Page
    public function home(){
        $produk = Produk::orderBy('id_menu','desc')->get();
        return view('admin.home', ['produk' => $produk, 'key' => 'home']);
    }
    // RUD Menu
    public function addmenu(){
        return view('admin.addmenu', ['key' => 'home']);
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
        return redirect('/home')->with('success', 'Produk berhasil ditambahkan.',['key' => 'home']);
    }

    public function editMenu($id){
        $produk = Produk::find($id);
        return view('admin.editmenu', ['produk' => $produk, 'key' => 'home']);
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
        return redirect('/home')->with('success', 'Produk berhasil diperbarui.',['key' => 'home']);
    }

    public function deleteMenu($id){
        $produk = Produk::find($id);
        if ($produk->gambar_produk && $produk->gambar_produk != 'images/noImage.jpg') {
            Storage::disk('public')->delete($produk->gambar_produk);
        }
        $produk->delete();
        return redirect('/home')->with('success', 'Produk berhasil dihapus.',['key' => 'home']);
    }

    // Users Page
    public function users(){
        $users = User::orderBy('id_user','desc')->get();
        return view('admin.users', ['users' => $users, 'key' => 'users']);
    }

    // Halaman Tambah User
    public function addUserForm(){
        return view('admin.adduser', ['key' => 'users']);
    }
    // RD Users
    public function saveAddUser(Request $request){
        $request->validate([
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email'        => 'required|email|unique:users,email',
            'no_telp'      => 'required|string|max:20',
            'password'     => 'required|min:6',
        ]);

        if ($request->hasFile('foto_profile')) {
            $file_name=time().'_'.$request->file('foto_profile')->getClientOriginalName();
            $file_path=$request->file('foto_profile')->storeAs('profile_images',$file_name,'public');
        }else{
            $file_path='profile_images/default.png';
        }

        User::create([
            'name'         => $request->input('nama'),
            'email'        => $request->input('email'),
            'phone_number' => $request->input('no_telp'),
            'photo'        => $file_path,
            'password'     => Hash::make(''.$request->input('password').''),
        ]);
        return redirect('/users')->with('success', 'User berhasil ditambahkan.',['key' => 'users']);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if ($user->photo && $user->photo != 'profile_images/default.png') {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();
        return redirect('/users')->with('success', 'User berhasil dihapus.',['key' => 'users']);

    }

    public function changePassForm(){
        return view('admin.changepassword');
    }
}
