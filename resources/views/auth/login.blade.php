<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Melody Admin') }} - Login</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy to see you again!</h6>

                            {{-- LARAVEL LOGIN FORM --}}
                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf

                                {{-- Email Field --}}
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input id="email" 
                                               type="email" 
                                               class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="Email Address"
                                               required 
                                               autocomplete="email" 
                                               autofocus>

                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password Field --}}
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input id="password" 
                                               type="password" 
                                               class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" 
                                               name="password" 
                                               placeholder="Password"
                                               required 
                                               autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Remember Me & Forgot Password --}}
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted" for="remember">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   name="remember" 
                                                   id="remember" 
                                                   {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="auth-link text-black">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>

                                {{-- Submit Button --}}
                                <div class="my-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        {{ __('LOGIN') }}
                                    </button>
                                </div>

                                {{-- Social Logins (Optional) --}}
                                <div class="mb-2 d-flex">
                                    <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                                        <i class="fab fa-facebook-f mr-2"></i>Facebook
                                    </button>
                                    <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                                        <i class="fab fa-google mr-2"></i>Google
                                    </button>
                                </div>

                                {{-- Registration Link --}}
                                @if (Route::has('register'))
                                    <div class="text-center mt-4 font-weight-light">
                                        Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Side Banner Image Column --}}
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                            Copyright &copy; {{ date('Y') }} All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>

</html>