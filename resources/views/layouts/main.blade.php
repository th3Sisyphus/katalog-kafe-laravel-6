<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Katalog Meja Kafe')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --brown-primary: #8B4513;
            --brown-dark: #5D2E0F;
            --brown-light: #D2691E;
            --black: #1a1a1a;
            --white: #FFFFFF;
            --cream: #F5F5DC;
        }

        body {
            background-color: var(--cream);
        }

        .header {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown-primary) 100%);
        }

        .header h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }

        .footer .contact {
            color: var(--brown-light);
        }

        .footer .contact a {
            color: var(--brown-light);
            transition: color 0.3s ease;
        }

        .footer .contact a:hover {
            color: var(--white);
        }

        .footer-divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--brown-primary), var(--brown-light));
        }
    </style>
    
    @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    
    <header class="header text-white py-4 shadow">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center"> <div class="flex-grow-1 text-center"> <h1 class="display-5 fw-bold m-0">☕ @yield('role') Meja Kafe ☕</h1>
                </div>
                @if (Auth::check())
                <div>
                    <div class="d-inline-block me-3 text-white">
                        <strong>Anda login sebagai: </strong> {{ Auth::user()->name }}
                    </div>
                    <a href="/changepassword" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-key me-1"></i> Ubah Password
                    </a>
                    <a href="/logout" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </div>
                @endif
            </div>
        </div>
    </header>

    <main class="main-content flex-grow-1 py-4 py-md-5">
        @yield('navbar')
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer bg-black text-white py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="copyright small mb-2">
                        &copy; {{ date('Y') }} Katalog Meja Kafe. All Rights Reserved.
                    </p>
                    
                    <div class="footer-divider mx-auto my-3"></div>
                    
                    <p class="contact small">
                        <strong>Hubungi Admin:</strong><br>
                        
                        <a href="mailto:admin@katalogmejakafe.com" class="text-decoration-none">admin@katalogmejakafe.com</a> | 
                        <a href="tel:+6281234567890" class="text-decoration-none">+62 812-3456-7890</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var msg = @json(session('success'));
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: msg,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            } else {
                alert(msg);
            }
        });
    </script>
    @endif
</body>
</html>