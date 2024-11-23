@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name', 'Floralyze') }} | {{ __('Register') }}</title>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Register') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('Full Name') }}</label>
                    <input type="name" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name" placeholder="Enter Full Name" autofocus>
                                        
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" placeholder="Enter your Email" autofocus>
                                        
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-form-label">{{ __('Gender') }}</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">{{ __('Male') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">{{ __('Female') }}</label>
                        </div>

                        @error('gender')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">{{ __('Password') }}</label>

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
                    <label for="password_confirmation" class="control-label">{{ __('Password Confirmation') }}</label>

                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter your Password Confirmation">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="togglePasswordConfirmation" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                                        
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 text-muted text-center">
        <a href="{{ route('login') }}">{{ __('Already Registered?') }}</a>
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

        $(document).ready(function() {
            $('#togglePasswordConfirmation').on('click', function() {
                const passwordField = $('#password_confirmation');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
@endpush