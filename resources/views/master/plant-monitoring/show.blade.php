@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'Floralyze') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Master') }}</li>
        <li class="breadcrumb-item">{{ __('Plant') }}</li>
        <li class="breadcrumb-item">{{ __('Monitoring') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('plant-monitoring.show', Crypt::encrypt($data->id)) }}">{{ __('Data') }}</a></li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h4><b>{{ $title }}</b></h4>
                    </div>
                    <div class="col">
                        <a href="{{ route('plant.index') }}" class="btn btn-warning float-right mr-2">
                            <span class="fas fa-arrow-left"></span> {{ __('Back') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudPlantMonitoring" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Date') }}</th>
                                    <th class="text-center">{{ __('Time') }}</th>
                                    <th class="text-center">{{ __('Temperature') }}</th>
                                    <th class="text-center">{{ __('Humidity') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var datatable = $('#crudPlantMonitoring').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('plant-monitoring.data', Crypt::encrypt($data->id)) }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'date', name: 'date'},
                { data: 'humidity', name: 'humidity', width: '10%', class: 'text-center' },
                { data: 'temperature', name: 'temperature', width: '10%', class: 'text-center' },
                { data: 'humidity', name: 'humidity', width: '10%', class: 'text-center' },
                { data: 'status', name: 'status', width: '10%', class: 'text-center' },
            ]
        })
    </script>
@endpush