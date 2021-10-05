@extends('frontEnd.layouts.master')
@section('title','Home')
@section('content')
 <div class="search-and-category">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="search-text">
 					<h5>The largest marketplace in Bangladesh!</h5>
 					<p>Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more in Bangladesh!</p>
 				</div>
 				<form  action="{{url('home-search')}}" method="get" class="main-search-box">
				@csrf
					<input type="text" name="keyword" placeholder="Search keyword" class="search-keyword" required="">
					<button>search</button>
			  </form>
			  <div class="category-section">
	 			@foreach($homecategories as $category)
				  <a href="{{url('category/'.$category->slug)}}">
					<div class="single-category">
						<ul>
							<li><img src="{{asset($category->image)}}"></li>
							<li><a href="{{url('category/'.$category->slug)}}">{{$category->name}} 
	                          </a></li>
						</ul>
					</div>
				</a>
			     <!-- single category end -->
			    @endforeach
	 		</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- search and category -->
 <div class="all-category">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-12">
 				<h4>All CATEGORIES</h4>
 			</div>
 		</div>
 		<div class="row">
 			@foreach($categories as $key=>$value)
 			<div class="col-sm-4">
 				<div class="allcategory-item">
 					<div class="row">
	 					<div class="col-sm-2">
	 						<img src="{{asset($value->image)}}" alt="">
	 					</div>
	 					<div class="col-sm-10">
	 						<div class="subcategory">
	 							<ul>
	 								<li class="highlight"><a href="{{url('category/'.$value->slug)}}">{{$value->name}}</a></li>
	 								@foreach($value->hsubcategories as $subcategory)
	 								<li><a href="">{{$subcategory->subcategoryName}}</a></li>
	 								@endforeach
	 							</ul>
	 						</div>
	 					</div>
	 				</div>
 				</div>
 			</div>
 			@endforeach
 		</div>
 	</div>
 </div>
<section class="post-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            	<div class="post-left">
            		<h4>Do you have something to sell?</h4>
            		<p>Post your ad on sellquicker.net/</p>
            		<a href="">post your ad</a>
            	</div>
            </div>
            <div class="col-sm-6">
                <div class="post-right">
                	<img src="{{asset('public/frontEnd/images/ads.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
 
@endsection