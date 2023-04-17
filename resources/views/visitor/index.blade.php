@extends('layouts.app')
@section('content')

    <h3>{{ config('app.name', '') }} : Administration</h3>
    @if ($records->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="d-none d-sm-block">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Purpose</th>
                    {{-- <th scope="col">Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($records as $record)
                    @php
                        $i++;
                    @endphp
                    <tr class="cursor-pointer" onClick="location.href='visitor/{{ $record->id }}'">
                        <td scope="row">{{ $record->id }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>{{ $record->datetime_out ?? '' }}</td>
                        <td>{{ $record->name }}</td>
                        <td class="d-none d-sm-block">{{ $record->email }}</td>
                        <td>{{ $record->contact }}</td>
                        <td>{{ $record->purpose }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- AppServiceProvider boot add bootstrap --}}
        {{ $records->links() }}
    @else
        <p>No record found.</p>
    @endif
@endsection
