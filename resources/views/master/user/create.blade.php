@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Floralyze') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Master') }}</li>
        <li class="breadcrumb-item">{{ __('Account') }}</li>
        <li class="breadcrumb-item">{{ __('Floralyze') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('user.create') }}">{{ __('Create') }}</a>
        </li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b>{{ $title }}</b>
                    </h4>
                </div>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Full Name*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Full Name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Gender*') }}</label>
                            <div class="col-sm-9">
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

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Email*') }}</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" class="form-control @error('grade') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan Email">

                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Role*') }}</label>
                            <div class="col-sm-9">
                                <select id="role" class="form-control select2 @error('role') is-invalid @enderror" name="role[]" multiple data-placeholder=" Select Roles">
                                    @foreach($roles as $rrole)
                                        <option value="{{ $rrole->name }}">{{ $rrole->name }}</option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Password*') }}</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('role.index') }}" class="btn btn-warning">{{ __('Back') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
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