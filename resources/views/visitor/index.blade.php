@section('content')
    @extends('layouts.app')

    <h3 class="mt-3">{{ config('app.name', '') }} </h3>
    <div class="col col-sm-12">
        <form class="d-flex" action="" method="GET" role="search">
            <div class="me-1 col col-sm-2">
                <label for="checkin_from">Check In (From):</label><br>
                <input name="checkin_from" class="form-control me-2" type="date" placeholder="dd-mm-yyyy"
                    value="{{ app('request')->input('checkin_from') }}" min="2000-01-01" max="{{ date('Y-m-d') }}"
                    aria-label="Search">
            </div>
            <div class="me-1 col col-sm-2">
                <label for="checkin_to">Check In (To):</label><br>
                <input name="checkin_to" class="form-control me-2" type="date" placeholder="dd-mm-yyyy"
                    value="{{ app('request')->input('checkin_to') }}" min="2000-01-01" max="{{ date('Y-m-d') }}"
                    aria-label="Search">
            </div>
            <div class="me-1 col col-sm-2">
                <label for="search">Search:</label><br>
                <input name="search" class="form-control me-2" type="search" placeholder="Search keyword"
                    value="{{ app('request')->input('search') }}" aria-label="Search">
            </div>
            <div class="me-1 col col-sm-3">
                <label for=""></label><br>
                <button class="btn btn-outline-primary" type="submit">Search</button>
                <a href="{{ route('visitor') }}" class="btn btn-outline-primary">Clear</a>
            </div>
        </form>
    </div>

    @if ($records->count())
        @php
            $user_filter_search = '';
            if (!empty(app('request')->input('search'))) {
                $user_filter_search = $user_filter_search . ' Search by : ' . app('request')->input('search');
            }
            if (!empty(app('request')->input('checkin_from'))) {
                $user_filter_search = $user_filter_search . ' Check In From : ' . app('request')->input('checkin_from');
            }
            if (!empty(app('request')->input('checkin_to'))) {
                $user_filter_search = $user_filter_search . ' Check In To : ' . app('request')->input('checkin_to');
            }
        @endphp

        <p class="mt-3">Total records found : {{ $records->total() }}. {{ $user_filter_search }}</p>
        {{-- <form action="{{ route('view-pdf') }}" method="post" target="__blank">
            @csrf
            <button class="text-white bg-primary">
                View PDF
            </button>
        </form> --}}
        {{-- <div style="width:auto; margin: 0 auto;">
            <div style="width: auto; float:left;" class="mx-auto">
                <form action="{{ route('download-excel') }}" method="post" target="__blank">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Download XLS</button>
                </form>
            </div>
            <div style="width: 50% float: left;">
                <form action="{{ route('download-pdf') }}" method="post" target="__blank">
                    @csrf
                    <button class="btn btn-primary" type="submit">Download PDF</button>
                </form>
            </div>
        </div> --}}
        <div>
            <div class="d-inline">
                <?php $disable = !$records->count() ? 'disabled' : ''; ?>
                <form action="{{ route('download-pdf') }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-primary" type="submit" <?php echo $disable; ?>>Download PDF</button>
                </form>
            </div>
            <div class="d-inline">
                <form action="{{ route('download-excel') }}" method="post" target="__blank" class="d-inline">
                    @csrf
                    <button class="btn btn-secondary" type="submit" <?php echo $disable; ?>>Download XLS</button>
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Transport</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Document</th>
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
                        <td class={{ $record->datetime_out ? '' : 'text-danger' }}>
                            {{ $record->datetime_out ? 'OUT' : 'IN' }}</td>
                        <td>{{ $record->datetime_in }}</td>
                        <td>{{ $record->datetime_out ?? '' }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->contact }}</td>
                        <td>{{ $record->transport ?? '' }}</td>
                        <td>{{ $record->purpose }}</td>
                        @if ($record->filepath)
                            <td><a href={{ $record->filepath }}>Download</a></td>
                        @else
                            <td>{{ $record->filepath }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- AppServiceProvider boot add bootstrap --}}
        {{-- {{ $records->links() }} --}}
        {{ $records->appends(request()->query())->links() }}
    @else
        <p class="mt-3">No record found.</p>
    @endif
@endsection
