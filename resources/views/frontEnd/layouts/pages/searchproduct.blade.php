@extends('frontEnd.layouts.master')
@section('title','Search Products')
@section('content')
<section class="advertisment">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				@include('frontEnd.layouts.pages.sidebar')
				<div class="mads">
					<a href="">
						<img src="{{asset('public/frontEnd/')}}/images/hproad1.jpg" alt="">
					</a>
				</div>
				<!-- mads end -->
			</div>
			<!-- first col-3 -->
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="ad-inner">
					<div class="ad-filter">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-sm-12">
								<h6><ul>
									<li><a href="{{url('/')}}">Home</a></li>
									<li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
									<li><a class="anchor">Search Products</a></li>
								</ul></h6>
								<p>{{$advertisments->count()}} advertisment find</p>
							</div>
							<!-- col end -->
							<div class="col-lg-6 col-sm-6 col-sm-12">
								<div class="sort-form">
									<form action="">
										<div class="from-group">
											<select name="adsort" id="">
												<option value="1">Newest on top</option>
												<option value="2">Oldest on top</option>
												<option value="3">High to Low</option>
												<option value="3">Low to High</option>
											</select>
										</div>
									</form>
								</div>
								<div class="grid-list">
									<ul class="nav nav-tabs" id="sortTab" role="tablist">
										  <li class="nav-item">
										    <a class="nav-link active" id="gridad-tab" data-toggle="tab" href="#gridad" role="tab" aria-controls="gridad" aria-selected="true"><i class="fa fa-th"></i></a>
										  </li>
										  <li class="nav-item">
										    <a class="nav-link" id="listad-tab" data-toggle="tab" href="#listad" role="tab" aria-controls="listad" aria-selected="false"><i class="fa fa-list"></i></a>
										  </li>
								   </ul>
								</div>
							</div>
							<!-- col end -->
						</div>
					</div>
					<div  class="tab-content" id="myTabContent">
						<div  class="tab-pane fade active show " id="gridad" role="tabpanel" aria-labelledby="gridad-tab">
							<div class="row">
								@foreach($advertisments as $key=>$value)
								<div class="col-lg-4 col-md-4 col-sm-6">
									<div class="single-ads">
										<div class="ads-image">
											<a href="{{url('details/'.$value->id)}}">
												@foreach($adsimage as $image)
					                             @if($value->id==$image->ads_id)
					                             <img src="{{asset($image->image)}}" alt="">
					                              @break
					                              @endif
					                         	 @endforeach
											</a>
										</div>
										<div class="ads-content">
											<ul class="catandloc">
												<li class="cat"><a href=""><i class="fa fa-circle-o"></i>{{$value->catname}}</a></li>
												<li class="loc"><a href=""><i class="fa fa-map-marker"></i>{{$value->subareaName}}</a></li>
											</ul>
											<div class="title">
												<a href="{{url('details/'.$value->id)}}">{{substr($value->title,0,50)}}..</a>
											</div>
											<ul class="price-wishlist">
												<li class="price">{{$value->price}}</li>
											    @if($value->membership)
											        <li class="wishlist"><a href="#">Premium</a></li>
										    	@endif
											</ul>
										</div>
									</div>
								</div>
								<!-- single ads end -->
								@endforeach
							</div>
						</div>
						<!-- tab one -->
						  <div class="tab-pane fade" id="listad" role="tabpanel" aria-labelledby="listad-tab">
						  	@foreach($advertisments as $key=>$value)
						  	<div class="list-product">
						  		<div class="row">
							  		<div class="col-lg-4 col-md-4 col-sm-6">
							  			<div class="list-ad-image">
							  				<a href="{{url('details/'.$value->id)}}">
							  					<img src="{{asset('public/frontEnd/')}}/images/ads1.jpg" alt="">
							  				</a>
							  			</div>
							  		</div>
							  		<div class="col-lg-4 col-md-4 col-sm-6">
							  			<div class="list-ad-info">
							  				<p><i class="fa fa-circle-o"></i> Home & Live</p>
							  				<p><i class="fa fa-map-marker"></i> Saidpur</p>
							  				<h5><a href="{{url('details/'.$value->id)}}">Appartment In Rangpur Sell..</a></h5>
							  				<p>Full fresh car.ac ok, door auto,1500 cc engine unstalled.paper fail</p>
							  				<strong>20000 BTD</strong>
							  				@if($value->membership)
											      <li class="wishlist"><a href="#">Premium</a></li>
										    @endif
							  			</div>
							  		</div>
							  		<div class="col-lg-4 col-md-4 col-sm-6">
							  			<div class="view-details">
							  				<a href="{{url('details/'.$value->id)}}">view details</a>
							  			</div>
							  		</div>
							  	</div>
						  	</div>
						  	<!-- list product end -->
						  	@endforeach
						  </div>
					</div>
				</div>
				<div class="cpaginate">
					{{$advertisments->links()}}
				</div>
			</div>
			<!-- first col-9 end -->
		</div>
		<!-- row end -->
	</div>
</section>
<!-- advertisment end -->
@endsection