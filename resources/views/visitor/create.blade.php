@extends('layouts.app')
@section('content')
    <h3>Visitor Registration Form</h3>

    <div class="container mt-3">

        <!-- Register Success message -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="/visitor" method="post">
            <!-- CROSS Site Request Forgery Protection -->
            @csrf
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} mt-2">
                <label><strong>Name </strong><span class="text-danger">*</span></label>
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <input type="text" class="form-control {{ $errors->has('name') ? 'border border-danger' : '' }}"
                    name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}">
            </div>


            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} mt-2">
                <label><strong>Email </strong><span class="text-danger">*</span></label>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="email" class="form-control  {{ $errors->has('email') ? 'border border-danger' : '' }}"
                    name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}">
            </div>


            <div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }} mt-2">
                <label><strong>Contact No. </strong><span class="text-danger">*</span></label>
                @if ($errors->has('contact'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('contact') }}</strong>
                    </span>
                @endif
                <input type="text" class="form-control {{ $errors->has('contact') ? 'border border-danger' : '' }}"
                    name="contact" id="contact" placeholder="Enter your contact no." value="{{ old('contact') }}">
            </div>

            <div class="form-group {{ $errors->has('purpose') ? ' has-error' : '' }} mt-2">
                <label><strong> Purpose of visit </strong><span class="text-danger">*</span></label>
                @if ($errors->has('purpose'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('purpose') }}</strong>
                    </span>
                @endif
                <textarea class="form-control {{ $errors->has('purpose') ? 'border border-danger' : '' }}" name="purpose"
                    id="purpose" rows="3" cols="30" placeholder="Enter purpose of visit/remarks">{{ old('purpose') }}</textarea>
            </div>
            <input type="submit" name="send" value="Submit" class="btn btn-primary mt-3 col-12 col-sm-2">
        </form>
    </div>
    <br>
@endsection
