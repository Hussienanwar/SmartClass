<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Smart Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary: #04a41a;
            --accent: #3cff00;
            --light-bg: #f7f9fc;
        }
        /* body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #e6eaff, #ffffff);
            overflow: hidden;
        } */
         body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #e6eaff, #ffffff);
    overflow-x: hidden; /* prevent horizontal scrolling */
    overflow-y: auto;   /* allow vertical scrolling */
}
.main-content {
    min-height: 100vh;
    padding: 40px 15px;
    overflow-y: auto;
}


        /* Creative Loader */
        #loader {
            position: fixed;
            z-index: 9999;
            height: 100%;
            width: 100%;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease;
        }

        .loader-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .dot-wave {
            display: flex;
            gap: 8px;
        }

        .dot {
            width: 12px;
            height: 12px;
            background: var(--primary);
            border-radius: 50%;
            animation: wave 1.3s infinite ease-in-out;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        .dot:nth-child(4) {
            animation-delay: 0.6s;
        }

        .dot:nth-child(5) {
            animation-delay: 0.8s;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateY(0);
                opacity: 0.5;
            }

            50% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        /* Main content */
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s ease-in forwards;
            animation-delay: 2.8s;
        }

        .card {
            background-color: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: scale(0.95);
            opacity: 0;
            animation: zoomIn 1s ease-out forwards;
            animation-delay: 3s;
        }

        .card h1 {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .btn-login {
            padding: 12px 35px;
            font-size: 1.1rem;
            border-radius: 10px;
            background-color: var(--primary);
            border: none;
            color: white;
            transition: 0.3s;
        }

        .btn-login:hover {
            color: #e6eaff;
            background-color: var(--accent);
        }

        .btn img {
            width: 20px;
            height: 20px;
        }

        /* Animations */
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
    <style>
    .icon-radio:checked+img {
        border-color: #198754 !important;
        box-shadow: 0 0 10px rgba(25, 135, 84, 0.6);
    }

    .icon-radio:checked~.checkmark {
        display: block !important;
    }

    .selectable-icon {
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .selectable-icon:hover {
        transform: scale(1.05);
    }
</style>
<style>
    .d-grid::-webkit-scrollbar {
        width: 6px;
    }

    .d-grid::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
</style>
</head>

<body>
    @yield('modals')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow" role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">
        <strong><i class="fas fa-exclamation-triangle me-2"></i>Validation Error!</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Fixed Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow" role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">
        <strong><i class="fas fa-check-circle me-2"></i>Success!</strong>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Fixed Error Message --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow" role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">
        <strong><i class="fas fa-times-circle me-2"></i>Error!</strong>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <!-- Creative Loader -->
    <div id="loader">
        <div class="loader-title">Smart Class</div>
        <div class="dot-wave">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <!-- Main Content -->
<div class="main-content flex-column">
    @auth
        <!-- Header Above Card -->
        <div class="bg-white shadow-sm rounded px-3 py-2 mb-2 w-100 d-flex justify-content-between align-items-center" style="max-width: 600px;">

            <!-- User Name (Right) -->
            <div class="fw-semibold text-dark">
                <img src="{{ asset('assets/MainFiles/logo.png') }}" alt="Math 101"
                                class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;">
                {{-- <i class="fas fa-user-circle me-1 text-primary"></i> --}}
                {{ Auth::user()->name }}
            </div>

            <!-- Logout Form (Left) -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>

        </div>
    @endauth

    <!-- Card Below Header -->
    <div class="card w-100" style="max-width: 600px; overflow-y: auto;">
    @yield('content')
</div>

</div>
@yield('outside')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Hide loader after delay -->
    <script>
        window.addEventListener("load", () => {
            setTimeout(() => {
                const loader = document.getElementById("loader");
                loader.style.opacity = 0;
                setTimeout(() => loader.style.display = "none", 600);
            }, 2000); // Duration of loader
        });
    </script>
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        const alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 7000); // Hide after 5 seconds
        }
    });
</script>
</body>
</html>
