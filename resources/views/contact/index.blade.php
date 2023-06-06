@section('content')
    @extends('layouts.app')
    <div class="col-lg-7 mx-auto mbr-form" data-form-type="formoid">
        <caption>
            <h3 class="mt-3">Contact Us Form</h3>
        </caption>
        <form action="{{ route('send-mail') }}" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
            @csrf
            <!-- Submit Success message -->
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <!-- submit error message -->
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="dragArea row">
                <div class="col-md col-sm-12 form-group mb-3" data-for="name">
                    <input type="text" name="name" placeholder="Full Name" data-form-field="name" class="form-control"
                        value="" id="name-form5-1x">
                </div>
                <div class="col-md col-sm-12 form-group mb-3" data-for="email">
                    <input type="email" name="email" placeholder="E-mail" data-form-field="email" class="form-control"
                        value="" id="email-form5-1x">
                </div>

                <div class="col-12 form-group mb-3" data-for="textarea">
                    <textarea name="message" placeholder="Message" data-form-field="textarea" class="form-control" id="textarea-form5-1x"></textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
                    <button type="submit" class="btn btn-primary display-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
