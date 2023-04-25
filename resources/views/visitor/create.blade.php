@section('content')
    @extends('layouts.app')
    <h3 class="mt-3">Visitor Registration Form</h3>
    <div class="container mt-3">

        <!-- Register Success message -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="/visitor" method="post" enctype="multipart/form-data">
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

            <div class="form-group {{ $errors->has('transport') ? ' has-error' : '' }} mt-2">
                <label><strong>Transport Type : </strong><span class="text-danger">*</span></label>
                <input type="radio" name="transport" value="Walk In"
                    {{ old('transport') == 'Walk In' ? 'checked' : '' }}> Walk-in
                <input type="radio" name="transport" value="Vehicle"
                    {{ old('transport') == 'Vehicle' ? 'checked' : '' }}> Vehicle
                @if ($errors->has('transport'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('transport') }}</strong>
                    </span>
                @endif
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
            <div class="form-group {{ $errors->has('document') ? ' has-error' : '' }} mt-2">
                <label><strong> Document </strong><span class="text-danger"></span></label>
                @if ($errors->has('document'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('document') }}</strong>
                    </span>
                @endif
                <input type="file" class="form-control {{ $errors->has('document') ? 'border border-danger' : '' }}"
                    accept="image/png,.jpeg,.jpg,.pdf,.doc" name="document" id="document" placeholder="select file."
                    value="{{ old('document') }}">
            </div>


            {{-- <input type="submit" name="send" value="Submit" class="btn btn-primary mt-3 col-12 col-sm-2"> --}}
            <Button type="submit" name="send" class="btn btn-primary mt-3 col-12 col-sm-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-send-fill" viewBox="0 0 16 16">
                    <path
                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                </svg>
                Submit
            </Button>
        </form>
    </div>
    <br>
@endsection
