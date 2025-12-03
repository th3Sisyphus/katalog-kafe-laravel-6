@extends('layouts.main')
@section('title', 'Login Page')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="col-sm-10 col-md-8 col-lg-5 col-xl-4">

        <div class="card border-0 shadow rounded-4 p-4 p-sm-5">

            <div class="text-center mb-4">
                <h3 class="fw-bold mb-1">Selamat Datang!</h3>
                <p class="text-muted mb-0">Silakan login ke akun Anda.</p>
            </div>

            <form action="/login33231244" method="post"> 
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">E-mail</label>
                    <input type="email" class="form-control form-control-lg rounded-3" id="email" name="email" placeholder="nama@contoh.com" required autofocus>
                </div>
    
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control form-control-lg rounded-3" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold">Login</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
