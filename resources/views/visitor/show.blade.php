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
    <h3>Visitor Details</h3>
    <div>Check-in Id : {{ $record->id }}</div>
    <div>Status : {{ $record->datetime_out ? 'OUT' : 'IN' }}</div>
    <div>Check-In : {{ $record->datetime_in }}</div>
    <div>Check-Out : {{ $record->datetime_out ?? '' }}</div>
    <div>Name : {{ $record->name }} </div>
    <div>Email : {{ $record->email ?? '' }} </div>
    <div>Contact no : {{ $record->contact }} </div>
    <div>Purpose of visit : {{ $record->purpose }} </div>
    <hr>

    <form action="/admin/visitor/{{ $record->id }}" method="post">
        @method('PUT')
        <!-- CROSS Site Request Forgery Protection -->
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="id" id="id" value="{{ $record->id }}">
        </div>

        <div class="container">
            <a href="/admin/visitor" class="btn btn-primary col-5 col-sm-2">Back</a>

            @if ($record->datetime_out)
                <a href="" class="btn btn-secondary col-5 col-sm-2 disabled">Check Out</a>
            @else
                <input type="submit" name="send" value="Check Out" class="btn btn-success col-5 col-sm-2">
            @endif
        </div>
    </form>
@endsection
