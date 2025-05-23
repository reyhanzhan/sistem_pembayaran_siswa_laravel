@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 col-sm-10">
                <div class="card login-card">
                    <div class="card-body">
                        <h3 class="text-center mb-4 font-weight-bold text-gray-800">Login</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name" class="form-label font-weight-bold text-gray-700">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" required autofocus placeholder="Enter your username">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label font-weight-bold text-gray-700">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control" required
                                        placeholder="Enter your password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                            tabindex="-1" title="Show/Hide Password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-check mb-4">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        {{-- <div class="text-center mt-3">
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection


@section('styles')
    <style>
        /* Tambahan styling jika diperlukan */
        .login-card {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
@endsection
