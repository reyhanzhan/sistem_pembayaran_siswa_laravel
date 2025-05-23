<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pembayaran Siswa</title>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo_kartini.jpeg') }}" type="image/x-icon" />
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background: #ffffff;
            animation: fadeIn 1s ease-in-out;
        }
        .login-card .card-body {
            padding: 2.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #d1d3e2;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }
        .input-group-prepend .input-group-text {
            border-radius: 8px 0 0 8px;
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-right: none;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
            transform: translateY(-2px);
        }
        .alert-danger {
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .form-check-label {
            font-size: 0.9rem;
            color: #6e707e;
        }
        .forgot-password {
            font-size: 0.85rem;
            color: #4e73df;
            text-decoration: none;
        }
        .forgot-password:hover {
            color: #2e59d9;
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 576px) {
            .login-card .card-body {
                padding: 1.5rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @yield('scripts')
</body>
</html>