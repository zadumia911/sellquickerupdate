@extends('frontEnd.layouts.master')
@section('title','Sign Up')
@section('content')
<section class="section-padding commonpanel">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-0"></div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="commonpanelform">
          <h5 class="title">Sign Up</h5>
            <form action="{{url('customer/register')}}" method="POST">
            	@csrf
                <div class="form-group">
                  <input type="text" class="form-control  {{$errors->has('name')? 'is-invalid' : ''}}" value="{{old('name')}}"  id="name" placeholder="Your Name" name="name" >
                  @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('name')}}</strong>
                    </span>
                  @endif
                </div>
                <!-- form group -->
                <div class="form-group">
                  <input type="text" class="form-control  {{$errors->has('phone')? 'is-invalid' : ''}}" placeholder="Your Phone" name="phone"   value="{{old('phone')}}" >
                  @if($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('phone')}}</strong>
                    </span>
                  @endif
                </div>
                <!-- form group -->
                <div class="form-group">
                  <input type="email" class="form-control  {{$errors->has('email')? 'is-invalid' : ''}}" placeholder="Your Email" name="email"   value="{{old('email')}}" >
                  @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif
              	</div>
                <!-- form group -->
                <div class="form-group">
                  <input type="password" class="form-control {{$errors->has('password')? 'is-invalid' : ''}}" placeholder="Your Password" name="password"  value="{{old('password')}}" >
                  @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('password')}}</strong>
                    </span>
                  @endif
                </div>
                <!-- form group -->
                <div class="form-group">
                  <input type="password" name="confirmed" class="form-control  {{$errors->has('confirmed')? 'is-invalid' : ''}}" id="confirmed" placeholder="confirm password" >
                  @if($errors->has('confirmed'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$errors->first('confirmed')}}</strong>
                    </span>
                  @endif
                </div>
                <!-- form group -->
                <div class="form-group" >
                  <div class="stayandforgate" >
                    <div class="ls-checkbox auth">
                      <label class="cat-chechbox"><p>I Am Agree Term and Policy</p>
                        <input type="checkbox" value="1">
                        <span class="checkmark"></span>
                      </label>
                     </div>
                  </div>
                </div>
                <div class="form-group">
                  <button>Register</button>
                </div>
                <!-- form group -->
                <div class="form-group newaccount">
                    <p>Already have a account?<a href="{{url('/customer/login')}}"> Log in</a></p>
                </div>
            </form>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3"></div>
    </div>
  </div>
</section>
@endsection