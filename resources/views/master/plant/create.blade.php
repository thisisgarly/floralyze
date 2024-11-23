@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Floralyze') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Master') }}</li>
        <li class="breadcrumb-item">{{ __('Plant') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('plant.create') }}">{{ __('Create') }}</a>
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
                <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Plant Code*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Enter Plant Code">

                                @error('code')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Plant Name*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Plant Name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Plant Type*') }}</label>
                            <div class="col-sm-9">
                                <input type="text" id="type" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" placeholder="Enter Plant Type">

                                @error('type')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('plant.index') }}" class="btn btn-warning">{{ __('Back') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush