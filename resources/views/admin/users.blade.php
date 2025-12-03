@extends('layouts.main')
@section('title', 'Users Dashboard')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css">
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
        <a class="navbar-brand" href="/users">Users</a>
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
<div class="table-responsive">
    <a href="users/addUser" class="btn btn-primary m-3"><i class="bi bi-person-plus"></i> Add New User</a>
    <table id="example" class="table table-striped table-hover display">
        <thead class="table-dark">
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Foto Profile</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $idx => $user)
            <tr>
                <td>{{ $idx+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td class="align-center">
                    <img src="{{ Storage::url($user->photo) }}" 
                            class="img-thumbnail" 
                            alt="{{ $user->name }}" 
                            style="max-width:100px; max-height:100px;">
                <td>
                    <a href="/users/delete/{{ $user->id_user }}" 
                       class="btn btn-danger btn-sm btn-delete" 
                       data-name="{{ $user->name }}" 
                       data-bs-toggle="tooltip" 
                       data-bs-placement="top" 
                       title="Hapus User">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script>
    new DataTable('#example');
</script>
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