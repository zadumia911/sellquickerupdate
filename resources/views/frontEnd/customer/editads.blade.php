@extends('frontEnd.layouts.master')
@section('title','Edit Ads')
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
                        <p>Edit Ads</p>
                    </div>
                    <div class="cbmain-content">
                        <form action="{{url('/customer/ads/published/update')}}" method="POST" novalidate enctype="multipart/form-data" name="editForm">
                        	@csrf
                        	<input type="hidden" value="{{$customerId = Session::get('customerId')}}" name="customer">
                              <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="category">Category <span>*</span></label>
                                      <select  name="category" id="category" class="form-control {{$errors->has('category')? 'is-invalid' : ''}}" required>
                                            <option value="">===Select Category===</option>
                                            @foreach($category as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                             @endforeach

                                             @if ($errors->has('category'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                          </span>
                                          @endif
                                        </select>
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="subcategory">Subcategory <span>*</span></label>
                                      <select  name="subcategory" class="form-control {{$errors->has('subcategory')? 'is-invalid' : ''}}" id="subcategory" required>
                                       	 <option value="">Select Subcategory</option>
                                         @foreach($subcategory as $key=>$value)
                                             <option value="{{$value->id}}">{{$value->subcategoryName}}</option>
                                          @endforeach

                                          @if ($errors->has('subcategory'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subcategory') }}</strong>
                                          </span>
                                          @endif
                                  	   </select>
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
                                        @foreach($districts as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->dist_name}}
                                        </option>
                                        @endforeach
                                        
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
                                        @foreach($thanas as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->thana_name}}
                                        </option>
                                        @endforeach
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
                                        @foreach($unions as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->union_name}}
                                        </option>
                                        @endforeach
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
                                      <select class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}" name="version" value="{{$edit_data->version}}" id="version" required="required">
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
                                <!--      <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{$edit_data->type}}" id="type">-->
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
                                      <input type="text" class="form-control{{$errors->has('brand')? 'is-invalid' : ''}}" id="brand" placeholder="Ads brand" name="brand" value="{{$edit_data->brand}}" required>

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
                                <!--      <input type="text" class="form-control{{$errors->has('model')? 'is-invalid' : ''}}" id="model" placeholder="Ads model" name="model" value="{{$edit_data->model}}" required>-->

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
                                <!--      <input type="text" class="form-control{{$errors->has('edition')? 'is-invalid' : ''}}" id="edition" placeholder="Ads edition" name="edition" value="{{$edit_data->edition}}" required>-->

                                <!--      @if ($errors->has('edition'))-->
                                <!--          <span class="invalid-feedback" role="alert">-->
                                <!--            <strong>{{ $errors->first('edition') }}</strong>-->
                                <!--          </span>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="title">Ads Title <span>*</span></label>
                                      <input type="text" class="form-control{{$errors->has('title')? 'is-invalid' : ''}}" id="title" placeholder="Ads Title" name="title" value="{{$edit_data->title}}" required>

                                      @if ($errors->has('title'))
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                          </span>
                                        @endif
                                    </div>
                                    <!-- form group -->
                                </div>
                                <!-- col end -->


                                <!--<div class="col-lg-12 col-md-12 col-sm-12">-->
                                <!--    <div class="form-group">-->
                                <!--      <label for="feature">Ads Feature <span>*</span></label>-->
                                <!--      <textarea id="feature" class="{{$errors->has('feature')? 'is-invalid' : ''}} form-control" name="feature" rows="10">{{$edit_data->feature}}</textarea>-->
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
                                      <textarea id="description" class="{{$errors->has('description')? 'is-invalid' : ''}} form-control" name="description" rows="10">{{$edit_data->description}}</textarea>
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
                                      <input type="text" class="form-control{{$errors->has('phone')? 'is-invalid' : ''}}" id="phone" placeholder="phone numbers" maxlength="25" name="phone" value="{{$edit_data->phone}}" required>

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
                                <!--      <input type="text" class="form-control{{$errors->has('email')? 'is-invalid' : ''}}" id="email" placeholder="Email numbers" maxlength="25" name="email" value="{{$edit_data->email}}">-->
                                <!--    </div>-->
                                    <!-- form group -->
                                <!--</div>-->
                                <!-- col end -->

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="price">Price <span>*</span></label>
                                      <input type="text" class="form-control{{$errors->has('price')? 'is-invalid' : ''}}" id="price" placeholder="25000" maxlength="25" name="price" value="{{$edit_data->price}}" required>

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
                                     <strong>Size: max:6MB, Weight:695, Height:325 ,type:jpg,jpeg,png</strong>
                                    <label for="image">Product Picture<span>*</span></label>

                                      <div class="clone hide" style="display: none;">
                                        <div class="control-group input-group" style="margin-top:10px">
                                          <input type="file" name="image[]" class="form-control">
                                          <div class="input-group-btn"> 
                                            <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="input-group control-group increment" >
                                        <input type="file" name="image[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                      </div>
                                       @foreach($adsimage as $image)
                                         @if($edit_data->id==$image->ads_id) 
                                          <div class="edit-img">
                                            <input type="hidden" class="form-control" value="{{$image->id}}" name="hidden_img">
                                           <img src="{{asset($image->image)}}" class="editimage" alt="">
                                            <a href="{{url('customer/ads/image/delete/'.$image->id)}}" class="btn btn-danger">Delete</a>
                                          </div>
                                         @endif
                                      @endforeach
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
                                      <button class="cbutton">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
  <script type="text/javascript">
   document.forms['editForm'].elements['category'].value="{{$edit_data->category_id}}"
   document.forms['editForm'].elements['subcategory'].value="{{$edit_data->subcategory_id}}"
   document.forms['editForm'].elements['division'].value="{{$edit_data->division_id}}",
   document.forms['editForm'].elements['district'].value="{{$edit_data->dist_id}}",
   document.forms['editForm'].elements['thana'].value="{{$edit_data->thana_id}}",
   document.forms['editForm'].elements['union'].value="{{$edit_data->union_id}}",
   document.forms['editForm'].elements['version'].value="{{$edit_data->version}}"
   document.forms['editForm'].elements['type'].value="{{$edit_data->type}}"
 </script>
@endsection