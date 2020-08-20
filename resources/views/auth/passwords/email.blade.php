@extends('layouts.tablequizapp')

<style>
.pel{
color:red;
}
</style>
@section('content')


<section class="container page__inner">
<div class="row">
<div class="col text-center">
</div>
</div>
<div class="row ">
<div class="text-center col">
<h2 class="bernhard">Reset Password</h2>


</div>
</div>

<div class="row align-items-center justify-content-center ">
<div class="col-md-7 col-lg-4">

@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


  <form method="POST" action="{{ route('password.email') }}">
 @csrf
 <div class="form-row">
    <div class="col-md-12">
        <label for="email">Email Address</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-12">
        <input id="email" type="email" class=" form-control mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email"  required>
    </div>
</div>
@if ($errors->has('email'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
@endif




<div class="form-row ">
    <div class="col-md-12 ">
        <button type="submit" class="btn btn-primary d-block">
            Send password reset link
        </button>
    </div>
</div>

</form>
</div>
</div>
</section>
@endsection

@section('footer_scripts')
@endsection