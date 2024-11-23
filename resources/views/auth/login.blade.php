@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name', 'Floralyze') }} | {{ __('Login') }}</title>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Login') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" placeholder="Enter your Email" autofocus>
                                        
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">{{ __('Password') }}</label>

                        @if (Route::has('password.request'))
                            <div class="float-right">
                                <a href="{{ route('password.request') }}" class="text-small">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        @endif
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your Password">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                                        
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        {{ __('Don\'t have an account?') }} <a href="{{ route('register') }}">{{ __('Create One') }}</a>
    </div>
    <div class="simple-footer">
        {{ __('Copyright') }} &copy; {{ __('Floralyze 2024') }}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
@endpush