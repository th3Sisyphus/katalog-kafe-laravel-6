@extends('layouts.main')
@section('title', 'Edit Menu')
@section('role')
    Admin
@endsection

@section('navbar')
<div class="container-fluid">
    <nav class="navbar navbar-dark p-3 navbar-expand-lg" style="background-color:#8B4513">
        <a class="navbar-brand" href="/home"><i class="bi bi-house"></i> Back to Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-link {{ $key === 'home' ? 'active' : '' }} " href="/home">Home</span></a>
            <a class="nav-link {{ $key === 'users' ? 'active' : '' }} " href="/users">Users</a>
            </div>
        </div>
    </nav>
</div>  
@endsection
@section('content')
<div class="container my-5">
    
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">Formulir Edit Menu</h3>
                </div>
                <div class="card-body p-4">

                    <form action="/editmenu/save/{{ $produk->id_menu }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label fw-bold">Nama Menu</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nama_menu" 
                                   name="nama_menu" 
                                   value="{{ $produk->nama_menu }}"
                                   placeholder="Contoh: Cappucino"
                                   required>
                        </div>

                        <div class="row g-3 mb-3">
                            
                            <div class="col-md-5">
                                <label for="harga_produk" class="form-label fw-bold">Harga Produk</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           class="form-control" 
                                           id="harga_produk" 
                                           name="harga_produk" 
                                           value="{{ $produk->harga_produk }}"
                                           placeholder="25000" 
                                           min="0"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="diskon" class="form-label fw-bold">Diskon</label>
                                <div class="input-group">
                                    <input type="number" 
                                           class="form-control" 
                                           id="diskon" 
                                           name="diskon" 
                                           value="{{ $produk->diskon }}"
                                           min="0"
                                           max="100"
                                           placeholder="0">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="stok" class="form-label fw-bold">Stok</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="stok" 
                                       name="stok" 
                                       value="{{ $produk->stok }}"
                                       min="0"
                                       placeholder="0"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih kategori...</option>
                                <option value="Makanan" {{ $produk->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ $produk->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            </select>
                        </div>


                        @if ($produk->gambar_produk)
                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold d-block">Gambar Saat Ini</label>
                            <img id="preview-img" src="{{ asset('storage/' . $produk->gambar_produk) }}" 
                                 alt="Gambar {{ $produk->nama_menu }}" 
                                 class="img-fluid img-thumbnail mb-2" 
                                 style="max-width:240px;">
                            <div class="form-text">Gambar saat ini akan tetap digunakan jika tidak memilih file baru.</div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="gambar_produk" class="form-label fw-bold">Gambar Produk</label>
                            <input class="form-control" 
                                   type="file" 
                                   id="gambar_produk" 
                                   name="gambar_produk"
                                   accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">
                                Format yang diterima: JPG, PNG. Maksimal 2MB.
                            </div>
                            <div class="text-danger small mt-1" id="gambarError"></div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">
                            
                            <a href="/" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Batal Edit
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>
                                Simpan Perubahan Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    (function(){
        const input = document.getElementById('gambar_produk');
        const previewImg = document.getElementById('preview-img');
        const errorEl = document.getElementById('gambarError');
        const form = input ? input.closest('form') : null;
        const submitBtn = form ? form.querySelector('button[type="submit"]') : null;
        const MAX_BYTES = 2 * 1024 * 1024; // 2MB
        let originalSrc = previewImg ? previewImg.src : null;

        function resetValidation(){
            if(errorEl) errorEl.textContent = '';
            if(submitBtn) submitBtn.disabled = false;
        }

        if(!input) return;

        input.addEventListener('change', function(e){
            const file = input.files && input.files[0];
            if(!file){
                // no file chosen, revert preview
                if(previewImg && originalSrc) previewImg.src = originalSrc;
                resetValidation();
                return;
            }

            if(!file.type.startsWith('image/')){
                if(errorEl) errorEl.textContent = 'Tipe file tidak valid. Harap pilih file gambar (JPG/PNG).';
                if(submitBtn) submitBtn.disabled = true;
                return;
            }

            if(file.size > MAX_BYTES){
                if(errorEl) errorEl.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                if(submitBtn) submitBtn.disabled = true;
                return;
            }

            // preview new file
            const reader = new FileReader();
            reader.onload = function(ev){
                if(previewImg) previewImg.src = ev.target.result;
            };
            reader.readAsDataURL(file);

            resetValidation();
        });
    })();
</script>
@endsection