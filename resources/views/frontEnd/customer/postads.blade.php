@extends('frontEnd.layouts.master')
@section('title','Post New Ads')
@section('content')
<section class="customer-bg section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 sm-hide">
                @include('frontEnd.customer.sidebar')
            </div>
            <!-- col end -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="customer-body">
                    <div class="title">
                        <p>Post New Ads</p>
                        @php
                            $customerInfo = App\Customer::find(Session::get('customerId'));
                            if($customerInfo->membership=1){
                             $memberAdsLimit = App\Membership::where('id',2)->first()->quantity; 
                            }else{
                                $memberAdsLimit = App\Membership::where('id',1)->first()->quantity; 
                            }
                            $memberThisMonthAds = App\Advertisment::where('customer_id',Session::get('customerId'))->whereMonth('created_at', Carbon\Carbon::now()->month)->count();
                        @endphp
                    </div>
                    <div class="cbmain-content">
                        @if($memberThisMonthAds < $memberAdsLimit)
                        <form action="{{url('/customer/0/control-panel/post-new-ads')}}" method="POST" novalidate enctype="multipart/form-data">
                        	@csrf
                        	<input type="hidden" value="{{$customerId = Session::get('customerId')}}" name="customer">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="category">Category  <span>*</span></label>
                                      <select  name="category" id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" value="{{old('category')}}" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                         @if ($errors->has('category'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('category') }}</strong>
	                                     </span>
	                                    @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="subcategory">Subcategory <span>*</span></label>
                                      <select  name="subcategory" class="form-control{{ $errors->has('subcategory') ? ' is-invalid' : '' }}"  id="subcategory" required>
                                       	 <option value="">Select Subcategory</option>
                                  	   </select>
                                  	   @if ($errors->has('subcategory'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('subcategory') }}</strong>
	                                     </span>
	                                    @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="division_id" >Divistion/Zila <span>*</span></label>
                                      <select class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" id="division" required="required">
                                          <option value="">Division</option>
                                               @foreach($divisions as $key=>$value)
  			                                      	<option value="{{$value->id}}">{{$value->name}}
  			                                      	</option>
			                                          @endforeach

                                               @if ($errors->has('division_id'))
			                                    <span class="invalid-feedback" role="alert">
			                                      <strong>{{ $errors->first('division_id') }}</strong>
			                                    </span>
			                                    @endif
                                      </select>
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="dist_id" >District <span>*</span></label>
                                     <div class="form-group">
                                      <select class="form-control" name="dist_id" id="district" required="required">
                                      	<option value="">District</option>
                                 	  </select>
                                 	   @if ($errors->has('dist_id'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('dist_id') }}</strong>
	                                     </span>
	                                    @endif
                                 </div>
                                 <!--form-group end-->
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="thana_id" >Thana <span>*</span></label>
                                     <div class="form-group">
                                      <select class="form-control" name="thana_id" id="thana" required="required">
                                        <option value="">Thana</option>
                                    </select>
                                     @if ($errors->has('thana_id'))
                                       <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('thana_id') }}</strong>
                                       </span>
                                      @endif
                                  </div>
                                 <!--form-group end-->
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="union_id" >Union/City Corporation <span>*</span></label>
                                     <div class="form-group">
                                      <select class="form-control" name="union_id" id="union" required="required">
                                        <option value="">Union</option>
                                    </select>
                                     @if ($errors->has('union_id'))
                                       <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('union_id') }}</strong>
                                       </span>
                                      @endif
                                  </div>
                                 <!--form-group end-->
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="version" >Condition <span>*</span></label>
                                      <select class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}" name="version" value="{{old('version')}}" id="version" required="required">
                                          <option value="">Select Condition</option>
                                               
                                                <option value="1">Used
                                                <option value="2">New
                                                </option>

                                               @if ($errors->has('version'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('version') }}</strong>
                                          </span>
                                          @endif
                                      </select>
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <!--<div class="col-lg-6 col-md-6 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="type" >Authenticity <span>(optional)</span></label>-->
                                <!--      <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{old('type')}}" id="type">-->
                                <!--          <option value="">Select Type</option>-->
                                <!--                <option value="1">Original-->
                                <!--                <option value="2">Copy-->
                                <!--                </option>-->
                                <!--      </select>-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="brand">Brand <span>*</span></label>
                                      <input type="text" class="form-control{{$errors->has('brand')? 'is-invalid' : ''}}" id="brand" placeholder="Ads brand" name="brand" value="{{old('brand')}}" required>

                                      @if ($errors->has('brand'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                          </span>
                                        @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <!--<div class="col-lg-6 col-md-6 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="model">Model <span>(optional)</span></label>-->
                                <!--      <input type="text" class="form-control{{$errors->has('model')? 'is-invalid' : ''}}" id="model" placeholder="Ads model" name="model" value="{{old('model')}}" required>-->

                                <!--      @if ($errors->has('model'))-->
                                <!--          <span class="invalid-feedback" role="alert">-->
                                <!--            <strong>{{ $errors->first('model') }}</strong>-->
                                <!--          </span>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->
                                <!--<div class="col-lg-6 col-md-6 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="edition">Edition <span>(Optional)</span></label>-->
                                <!--      <input type="text" class="form-control{{$errors->has('edition')? 'is-invalid' : ''}}" id="edition" placeholder="Ads edition" name="edition" value="{{old('edition')}}" required>-->

                                <!--      @if ($errors->has('edition'))-->
                                <!--          <span class="invalid-feedback" role="alert">-->
                                <!--            <strong>{{ $errors->first('edition') }}</strong>-->
                                <!--          </span>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                      <label for="title">Ads Title <span>*</span></label>
                                      <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" placeholder="Ads Title" name="title" value="{{old('title')}}" required>
                                    </div>
                                     @if ($errors->has('title'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('title') }}</strong>
	                                     </span>
	                                    @endif
                                    <!-- form group -->
                                </div>
                                <!-- col end -->


                                <!--<div class="col-lg-12 col-md-12 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="feature">Ads Feature <span>*</span></label>-->
                                <!--      <textarea id="feature" class="{{$errors->has('feature')? 'is-invalid' : ''}} form-control" name="feature" rows="6">{{old('feature')}}</textarea>-->
                                <!--      @if ($errors->has('feature'))-->
                                <!--          <span class="invalid-feedback" role="alert">-->
                                <!--            <strong>{{ $errors->first('feature') }}</strong>-->
                                <!--          </span>-->
                                <!--          @endif-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                      <label for="description">Ads Description <span>*</span></label>
                                      <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"name="description" rows="6">{{old('description')}}</textarea>
                                      @if ($errors->has('description'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('description') }}</strong>
	                                     </span>
	                                    @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="phone">Phone Numbers <span>*</span></label>
                                      <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" placeholder="phone numbers" maxlength="25" name="phone" value="" required>
                                      @if ($errors->has('phone'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('phone') }}</strong>
	                                     </span>
	                                    @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <!--<div class="col-lg-6 col-md-6 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="email">Email Address <span>(optional)</span></label>-->
                                <!--      <input type="text" class="form-control" id="email" placeholder="Email numbers" maxlength="25" name="email" value="">-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="price">Price <span>*</span></label>
                                      <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" placeholder="25000 Taka" maxlength="25" name="price" value="{{old('price')}}" required>
                                       @if ($errors->has('price'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('price') }}</strong>
	                                     </span>
	                                    @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <strong>Size: max:6MB, Weight:695, Height:325 ,type:jpg,jpeg,png</strong><br>
                                    <label for="image">Product Picture<span>*</span></label>

                                      <div class="clone hide" style="display: none;">
                                        <div class="control-group input-group{{ $errors->has('image') ? ' is-invalid' : '' }}" style="margin-top:10px">
                                          <input type="file" name="image[]" class="form-control">
                                          <div class="input-group-btn"> 
                                            <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="input-group control-group increment{{ $errors->has('image') ? ' is-invalid' : '' }}" >
                                        <input type="file" name="image[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                      </div>
                                      @if ($errors->has('image'))
	                                     <span class="invalid-feedback" role="alert">
	                                      <strong>{{ $errors->first('image') }}</strong>
	                                     </span>
	                                    @endif
                                  </div>
                                </div>
                                <!-- col end -->
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                      <button class="cbutton">Post Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <p>Your monthly limit over</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-3 col-md-3 col-sm-12 lg-hide sm-show">
                @include('frontEnd.customer.sidebar')
            </div>
            <!-- col end -->
        </div>
    </div>
</section>
@endsection