@extends('layouts.main')

@section('title', 'Tambah User Baru')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<style>
        .iti {
            width: 100%;
            display: block;
        }
        
        input#phone {
            padding-left: 90px !important;
        }
    </style>
@endsection
@section('navbar')
<div class="container-fluid">
    <nav class="navbar navbar-dark p-3 navbar-expand-lg" style="background-color:#8B4513">
        <a class="navbar-brand" href="/users"><i class="bi bi-people"></i> Back to Users</a>
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
                    <h3 class="mb-0">Formulir User Baru</h3>
                </div>
                <div class="card-body p-4">

                    <form action="/users/save" method="POST" enctype="multipart/form-data">
                        
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama User</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nama" 
                                   name="nama" 
                                   placeholder="Contoh: John Doe" 
                                   required>
                        </div>

                        <div class="row g-3 mb-3">
                            
                            <div class="col-md-5">
                                <label for="email" class="form-label fw-bold">E-Mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           placeholder="john.doe@example.com" 
                                           required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="no_telp" class="form-label fw-bold">No. Telepon</label>
                                <input type="tel" class="form-control" id="phone" placeholder="812-3456-7890" required>
                                <input type="hidden" name="no_telp" id="no_telp_full">
                                <small class="form-text text-muted">Pilih negara untuk kode otomatis.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password <small class="text-muted">(min. 6 karakter)</small></label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Masukkan password yang kuat" 
                                   required>
                        </div>


                        <div class="mb-3">
                            <label for="foto_profile" class="form-label fw-bold">Foto Profile</label>
                            <div id="preview-container" class="mb-2 text-center" style="display:none;">
                                <img id="preview-img" src="#" alt="Preview Gambar" class="img-fluid img-thumbnail" style="max-width:240px;" />
                            </div>
                            <input class="form-control" 
                                   type="file" 
                                   id="foto_profile" 
                                   name="foto_profile"
                                   accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">
                                Format yang diterima: JPG, PNG. Maksimal 2MB.
                            </div>
                            <div class="text-danger small mt-1" id="gambarError"></div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">
                            
                            <a href="/users" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>
                                Simpan Menu Baru
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    (function(){
        const input = document.getElementById('foto_profile');
        const previewContainer = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-img');
        const errorEl = document.getElementById('gambarError');
        const form = input ? input.closest('form') : null;
        const submitBtn = form ? form.querySelector('button[type="submit"]') : null;
        const MAX_BYTES = 2 * 1024 * 1024; // 2MB

        function resetValidation(){
            errorEl.textContent = '';
            if(submitBtn) submitBtn.disabled = false;
        }

        if(!input) return;

        input.addEventListener('change', function(e){
            const file = input.files && input.files[0];
            if(!file){
                previewContainer.style.display = 'none';
                previewImg.src = '#';
                resetValidation();
                return;
            }

            // validate type
            if(!file.type.startsWith('image/')){
                errorEl.textContent = 'Tipe file tidak valid. Harap pilih file gambar (JPG/PNG).';
                previewContainer.style.display = 'none';
                if(submitBtn) submitBtn.disabled = true;
                return;
            }

            // validate size
            if(file.size > MAX_BYTES){
                errorEl.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                previewContainer.style.display = 'none';
                if(submitBtn) submitBtn.disabled = true;
                return;
            }

            // preview
            const reader = new FileReader();
            reader.onload = function(ev){
                previewImg.src = ev.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);

            resetValidation();
        });
    })();
</script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        separateDialCode: true,
        initialCountry: "id",
        preferredCountries: ["id", "us", "gb"],
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    const form = document.querySelector("form");
    const hiddenInput = document.querySelector("#no_telp_full");
    form.addEventListener('submit',function(e){
        e.preventDefault();
        const fullNumber = phoneInput.getNumber();

        hiddenInput.value = fullNumber;
        console.log(fullNumber);
        
        if (phoneInput.isValidNumber()) {
            form.submit();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Nomor Tidak Valid',
                text: 'Nomor telepon yang Anda masukkan tidak sesuai dengan format negara yang dipilih.',
                confirmButtonText: 'Perbaiki'
            });

            phoneInputField.classList.add('is-invalid');
        }
    })
}) 
</script>
@endsection
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    });
</script>
@endif

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function(){
        var errorMessages = "";
        @foreach ($errors->all() as $error)
            errorMessages += "<li>{{ $error }}</li>";
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan',
            html: "<ul style='text-align: left;'>" + errorMessages + "</ul>",
        });
    });
</script>
@endif