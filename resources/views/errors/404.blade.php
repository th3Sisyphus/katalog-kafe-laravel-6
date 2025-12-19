@extends('layouts.main')

@section('content')
<div class="container text-center" style="padding: 100px 0;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-1 text-muted">404</h1>
            <h2 class="mb-4">Oops! Halaman Tidak Ditemukan</h2>
            
            <p class="lead mb-4 text-secondary">
                Sepertinya Anda mencoba mengakses menu atau halaman yang sudah tidak ada (atau belum pernah dibuat).
            </p>

            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                <i class="fa fa-home"></i> Kembali ke Menu Utama
            </a>
        </div>
    </div>
</div>
@endsection