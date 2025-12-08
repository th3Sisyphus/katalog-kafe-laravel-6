@extends('layouts.main')
@section('title', 'Menu Dashboard')
@section('role')
    Admin
@endsection

@section('styles')
<style>
    .card-add-new {
            border: 2px dashed var(--bs-primary);
            transition: all 0.2s ease-in-out;
            height: 100%;
        }

        .card-add-new:hover {
            background-color: var(--bs-primary-bg-subtle);
            border-style: solid;
        }

        .card-product-img {
            max-height: 250px;
            object-fit: cover;
        }
</style>
@endsection
@section('navbar')
<div class="container-fluid">
    <nav class="navbar navbar-dark p-3 navbar-expand-lg" style="background-color:#8B4513">
        <a class="navbar-brand" href="/home">Home</a>
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
        <div class="">

        </div>
        <div class="mb-4 d-flex align-items-center">
            Total Products: <span class="badge bg-secondary">{{ count($produk) }}</span>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="/addmenu" class="card card-add-new text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-plus-lg display-1 text-primary"></i>
                        <h5 class="mt-3 text-primary mb-0">Add New Product</h5>
                    </div>
                </a>
            </div>
            @foreach($produk as $idx => $item)
            <div class="col-md-6 col-lg-4 hover:shadow-lg">
                <div class="card h-100 shadow-sm ">
                    <div class="position-relative">
                        @if ($item->gambar_produk)
                            <img src="{{ Storage::url($item->gambar_produk) }}" 
                                 class="card-img-top card-product-img" 
                                 alt="{{ $item->nama_menu }}">
                        @else
                            <img src="https://via.placeholder.com/600x400.png?text=No+Image" 
                                 class="card-img-top card-product-img" 
                                 alt="{{ $item->nama_menu }}">
                        @endif
                        @if($item->diskon>0)
                        <span class="badge bg-danger fs-6 position-absolute top-0 end-0 m-3">
                            Diskon
                        </span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        
                        <div>
                            <h5 class="card-title">{{ $item->nama_menu }}</h5>
                            <p class="card-text fs-5">
                                @if($item->diskon>0)
                                <del class="text-muted small">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</del> 
                                <span class="fw-bold text-danger">Rp {{ number_format($item->harga_produk - ($item->harga_produk * $item->diskon / 100), 0, ',', '.') }}</span>
                                @else
                                <span class="fw-bold text-danger">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</span>
                                @endif
                            </p>
                            <p class="card-text small mb-3">Stok: <span class="fw-bold">{{ $item->stok }}</span></p>
                        </div>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            
                            <div class="d-flex gap-2">
                                @if($item->stok > 0)
                                <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle align-self-center">
                                    Tersedia
                                </span>
                                @else
                                <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle align-self-center">
                                    Habis
                                </span>
                                @endif
                                <span class="badge {{ $item->kategori === 'Minuman' ? 'bg-primary-subtle text-primary-emphasis border-primary-subtle' : 'bg-warning-subtle text-warning-emphasis border-warning-subtle' }} align-self-center">
                                    {{ $item->kategori }}
                                </span>
                                <a href="/editmenu/{{ $item->id_menu }}" class="btn btn-warning float-left"><i class="bi bi-pencil-square"></i></a>
                                <a href="/deletemenu/{{ $item->id_menu }}" class="btn btn-danger float-left btn-delete" data-name="{{ $item->nama_menu }}"><i class="bi bi-trash3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                var productName = btn.getAttribute('data-name') || 'data ini';
                var href = btn.getAttribute('href');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    html: '<strong>' + productName + '</strong><br>Data yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            didOpen: () => {
                                Swal.showLoading();
                                setTimeout(function(){ window.location.href = href; }, 250);
                            },
                            allowOutsideClick: false,
                            showConfirmButton: false
                        })
                    }
                });
            });
        });
    });
</script>
@endsection