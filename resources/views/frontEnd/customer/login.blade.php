@extends('frontEnd.layouts.master')
@section('title','Sign In')
@section('content')
<section class="section-padding commonpanel">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-0"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="commonpanelform">
          <h5 class="title">Sign In</h5>
            <form action="{{url('/customer/login')}}" method="POST">
              @csrf
                <div class="form-group">
                  <input type="text" class="form-control {{$errors->has('phoneOremail')? 'is-invalid' : ''}}" placeholder="Phone Or Email" name="phoneOremail" value="{{old('phoneOremail')}}">
                  @if($errors->has('phoneOremail'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('phoneOremail')}}</strong>
                    </span>
                  @endif
                 </div>
                <!-- form group -->
                <div class="form-group">
                  <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Your Password" name="password"  value="{{old('password')}}" >
                   @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
                <!-- form group -->
                <div class="form-group">
                  <div class="stayandforgate">
                     <div class="ls-checkbox auth">
                      <label class="cat-chechbox"><p>remember me</p>
                        <input type="checkbox" value="1">
                        <span class="checkmark"></span>
                      </label>
                     </div>
                     <div class="forgatepassowre">
                        <a href="{{url('customer/forget/password')}}">forgate passowrd</a>
                     </div>
                  </div>
                </div>
                <div class="form-group">
                  <button>Login</button>
                </div>
                <!-- form group -->
                <div class="form-group newaccount">
                    <p>If you don’t have account?<a href="{{url('customer/register')}}"> Create An Account</a></p>
                </div>
            </form>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3"></div>
    </div>
  </div>
</section>
@endsection