@extends('layouts.main')

@section('title', 'Katalog Menu')

@section('role')
    Katalog
@endsection

@section('styles')
<style>
    /* Hero Section Gradient */
    .hero-card {
        background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown-primary) 100%);
        border: none;
    }

    /* Efek Hover pada Kartu Menu */
    .hover-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid rgba(0,0,0,0.05); /* Border halus */
    }
    .hover-card:hover {
        transform: translateY(-8px); /* Naik sedikit saat dihover */
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.15) !important; /* Bayangan lebih lembut */
        border-color: var(--brown-light);
    }

    /* Input Pencarian */
    .search-input:focus {
        box-shadow: none;
        border-color: transparent;
    }
    .search-container {
        transition: box-shadow 0.3s ease;
    }
    .search-container:focus-within {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endsection

@section('content')

<div class="row justify-content-center mb-5">
    <div class="col-md-12">
        <div class="card hero-card shadow rounded-4 overflow-hidden text-white">
            <div class="card-body p-4 p-md-5 text-center">
                <h2 class="display-6 fw-bold mb-3">Mau pesan apa hari ini?</h2>
                <p class="mb-4 text-white-50 fs-5">Temukan cita rasa favoritmu di Katalog Meja Kafe</p>
                
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <form action="/" method="GET">
                            <div class="input-group input-group-lg bg-white rounded-pill p-1 shadow-sm search-container">
                                <input type="text" 
                                       name="search" 
                                       class="form-control border-0 rounded-pill ps-4 search-input" 
                                       placeholder="Cari menu (contoh: Kopi, Nasi Goreng...)"
                                       value="{{ $search ?? '' }}" 
                                       autocomplete="off">
                                <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark m-1" type="submit">
                                    <i class="bi bi-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($search) && $search != '')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h5 class="text-muted mb-0">Hasil pencarian: <span class="text-dark fw-bold">"{{ $search }}"</span></h5>
    <a href="/" class="btn btn-sm btn-outline-danger rounded-pill">
        <i class="bi bi-x-lg me-1"></i> Hapus Filter
    </a>
</div>
<div class="row g-4">
@forelse($produk as $item)  
<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 rounded-4 hover-card overflow-hidden bg-white">
        
        <div class="position-relative">
            <img src="{{ $item->gambar_produk ? asset('storage/'.$item->gambar_produk) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                class="card-img-top" 
                alt="{{ $item->nama_menu }}"
                style="height: 200px; object-fit: cover;">
            
            <span class="position-absolute top-0 start-0 m-2 m-md-3 badge bg-white text-dark shadow-sm rounded-pill px-3 py-2 border fw-normal">
                {{ $item->kategori }}
            </span>

            @if($item->diskon > 0)
            <span class="position-absolute top-0 end-0 m-2 m-md-3 badge bg-danger shadow-sm rounded-pill px-2">
                -{{ $item->diskon }}%
            </span>
            @endif
        </div>

        <div class="card-body d-flex flex-column p-3 p-md-4">
            <div class="mb-2">
                <h5 class="card-title fw-bold text-dark mb-1 text-truncate" title="{{ $item->nama_menu }}">
                    {{ $item->nama_menu }}
                </h5>
                <small class="{{ $item->stok > 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                    <i class="bi bi-circle-fill me-1" style="font-size: 6px; vertical-align: middle;"></i> 
                    {{ $item->stok > 0 ? 'Tersedia: '.$item->stok : 'Habis' }}
                </small>
            </div>

            <div class="mt-auto pt-3 border-top">
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-start">
                        @if($item->diskon > 0)
                            @php
                                $harga_diskon = $item->harga_produk - ($item->harga_produk * ($item->diskon/100));
                            @endphp
                            <div class="text-decoration-line-through text-muted small" style="font-size: 0.8rem;">
                                Rp {{ number_format($item->harga_produk, 0, ',', '.') }}
                            </div>
                            <div class="fw-bold text-primary fs-5">
                                Rp {{ number_format($harga_diskon, 0, ',', '.') }}
                            </div>
                        @else
                            <div class="text-muted small" style="font-size: 0.8rem;">Harga</div>
                            <div class="fw-bold text-primary fs-5">
                                Rp {{ number_format($item->harga_produk, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- <button class="btn btn-light rounded-circle text-primary shadow-sm" style="width: 35px; height: 35px; padding: 0;">
                        <i class="bi bi-plus-lg"></i>
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed">
        <i class="bi bi-cup-hot display-1 text-muted opacity-25"></i>
        <h4 class="mt-3 text-dark fw-bold">Menu tidak ditemukan</h4>
        <p class="text-muted">Maaf, kami tidak dapat menemukan menu dengan kata kunci "<strong>{{ $search }}</strong>".</p>
        <a href="/" class="btn btn-primary rounded-pill px-4 mt-2">
            Lihat Semua Menu
        </a>
    </div>
</div>
@endforelse
</div>
@else
<div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed">
    <i class="bi bi-search display-1 text-muted opacity-25"></i>
    <h4 class="mt-3 text-dark fw-bold">Ketik menu yang Anda cari</h4>
    <p class="text-muted">Gunakan kolom pencarian di atas untuk menemukan menu favorit Anda.</p>
</div>
@endif
</div>
@endsection