@extends('layouts.app')
@section('content')
    <!-- Register Success message -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <h3 class="mt-3">{{ config('app.name', '') }} </h3>
    <hr>
    <h3>Dashboard</h3>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="bg-success col-sm rounded-3 m-2 text-white">
                <div class="m-3">
                    <h5 class="mt-3">Visitors Today - {{ date('d-M-Y') }} </h5>
                    <div>Total : {{ $today_count }}</div>
                    <div>In Premises : {{ $today_in_now }}</div>
                    <div>Check Out : {{ $today_count_out }}</div>
                </div>
            </div>
            <div class="bg-warning col-sm rounded-3 m-2 text-white">
                <div class="m-3">
                    <h5 class="mt-3">Visitors This Month </h5>
                    <div>{{ date('M-Y') }}</div>
                    <div>Total : {{ $month_count }}</div>
                </div>
            </div>
            <div class="bg-primary col-sm rounded-3 m-2 text-white">
                <div class="m-3">
                    <h5 class="mt-3">Total Visitors To Date {{ date('d-M-Y') }} </h5>
                    <div>Total : {{ $to_date_count }}</div>
                </div>
            </div>
        </div>
    </div>

    <hr>
@endsection
