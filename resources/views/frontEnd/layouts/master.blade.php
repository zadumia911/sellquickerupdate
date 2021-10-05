<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title','Home') - Sellquicker  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @foreach($faveicon as $key=>$value)
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset($value->image)}}">
    @endforeach
    <!-- all css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/bootstrap.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/font-awesome.min.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/feathericon.min.css">
    <!-- feathericon css -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/dist/css/toastr.min.css">
    <!-- toastr -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/swiper-menu.css">
    <!-- swiper-menu css -->

    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/theme.css">
    <!-- mtree css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <!-- summernote css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/owl.carousel.min.css">
    <!-- owl.carousel.min css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/owl.theme.default.css">
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/nice-select.css">
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/style.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/responsive.css">
    <!-- responsive css -->
    <script src="{{asset('public/frontEnd/')}}/js/jquery-3.4.1.min.js"></script>
    <script data-ad-client="ca-pub-3346835581317070" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
	<div class='gotop'></div>
	<header class="show-nav">
		<div class="header-top ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="header-top-left">
	                        <div class="main-logo">
	                            <a href="{{url('/')}}">
                                    @foreach($wlogo as $key=>$value)
	                                <img src="{{asset($value->image)}}" class="desktop-logo" alt="">
                                    @endforeach
                                    @foreach($dlogo as $key=>$value)
	                                <img src="{{asset($value->image)}}" class="mobile-logo" alt="">
                                    @endforeach
	                            </a>
	                        </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <ul class="header-top-right">
                            <li><a href="{{url('all-ads')}}">all ads</a></li>
                            @php
                                 $customerId=Session::get('customerId');
                                  $customerInfo=App\Customer::where(['id'=>$customerId])->first();
                            @endphp
                            @if($customerId==NULL)
                            <li><a href="{{url('customer/login')}}"></i>Login</a></li>
                            @endif
                            @if($customerId!==NULL)
                             <li><a href="{{url('/customer/0/control-panel/dashboard')}}">My Account</a>
                                 <ul class="cat-submenu">
                                   <li><a href="{{url('customer/0/control-panel/dashboard')}}">Manage Account</a></li>
                                   <li><a href="{{url('customer/0/control-panel/membership-request')}}">My Membership</a></li>
                                 </ul>
                             </li>
                              <li><a href="{{url('customer/logout')}}">Logout</a></li>
                            @endif
                            <li class="post-ads"><a href="{{url('customer/0/control-panel/post-new-ads')}}">post your ad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--header top end-->
    </header>
    <!--header end-->
    <section class="mobile-menu ">
        <div class="swipe-menu default-theme">            
            <nav class="codehim-nav">
                    <ul class="menu-item">
                         @if($customerId!==NULL)
                        <li> <a href="{{url('/')}}">Home</a> </li>
                        @php
                             $customerId=Session::get('customerId');
                              $customerInfo=App\Customer::where(['id'=>$customerId])->first();
                        @endphp
                         <li><a href="">Inbox</a></li>
                         <li><a href="{{url('customer/0/control-panel/manage-my-ads')}}">Promote Single Ad</a></li>
                         <li><a href="{{url('customer/0/control-panel/dashboard')}}">Manage Account</a></li>
                         <li><a href="{{url('customer/0/control-panel/membership-request')}}">My Membership</a></li>
                         <li><a href="https://www.facebook.com/groups/440866056936777">Complain & Support</a></li>
                         <li><a href=" https://play.google.com/store/apps/details?id=hat.com.hatbodol&fbclid=IwAR3fbWVKNIyThEjTl0tVX27kzMGfjM4tyaFJV38039SyGSgvxLUXfVhd70A" target="_blank">Download our app</a></li>
                         <li class="mobile-logout"><a href="{{url('customer/logout')}}">Logout</a></li>
                        
                        @else
                        <li class="mobile-signin"><a href="{{url('customer/register')}}">SIGN UP</a></li>
                        <li><a href="{{url('/')}}" class="active">Home</a></li>
                        <li><a href="{{url('page/about-us')}}">About Us</a></li>
                        <li><a href="{{url('page/stay-safe')}}" >Stay Safe</a></li>
                        <li><a href="{{url('page/about-membership')}}" >About Membership</a></li>
                        <li class="mobile-logout"><a href="{{url('customer/login')}}"></i>Login</a></li>
                        @endif
                    </ul>
                <!--//Tab-->
            </nav>

        <!--Navigation Icon-->
        	<div class="mobile-logo">
        		<a href="{{url('/')}}">
                    @foreach($dlogo as $logo)
        			<img src="{{asset($logo->image)}}" alt="">
                    @endforeach
        		</a>
        	</div>
            <div class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </section>
    <!-- mobile menu end -->
    @yield('content')
<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
                <div class="col-sm-3">
                    <div class="footer-item">
                        <h4>Download Apps</h4>
                        <a href="">
                            <img src="{{asset('public/frontEnd/')}}/images/app.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-item">
                        <h4>Menu</h4>
                        <ul>
                            @foreach($aboutcompanies as $key=>$value)
                            <li><a href="{{url('page/'.$value->slug)}}" class="">{{$value->pagename}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-item">
                        <h4>Contact Us</h4>
                        <ul>
                            <li><a href="" class="">
                            House #8 (1st Floor), Road # 14,Dhanmondi, Dhaka-1209, Email: support@evaly.com.bd ,Contact no: 09638111666</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-item footer-social">
                        <h4>Get In  Touch</h4>
                        <ul>
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-instagram"></i></a></li>
                            <li><a href=""><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<!-- footer-top end -->
	<div class="footer-bottom">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="copyright">
						<p>@php date('Y') @endphp &copy copyright all right reserved sellquicker.net</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-bottom end -->
</footer>
@if(Request::segment(1)=='')
<div class="home-space"></div>
@endif
<!-- all jquery script -->
<script src="{{asset('public/frontEnd/')}}/js/swiper-menu.js"></script>
<!--swiper-menu   js-->
<script src="{{asset('public/frontEnd/')}}/js/jquery.ajax.js"></script>
<!-- ajax js -->
<script src="{{asset('public/frontEnd/')}}/js/bootstrap.min.js"></script>
<!-- boostrap css -->
<script src="{{asset('public/frontEnd/')}}/js/owl.carousel.min.js"></script>
<!--carousel js-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<!--waypoints js-->
<script src="{{asset('public/frontEnd/')}}/js/jquery.counterup.min.js"></script>
<!--counterup js-->
<script src="{{asset('public/frontEnd/')}}/js/jquery.scrollUp.js"></script>
<!--scrollup  js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
  <!-- summernote js -->
<script src="{{asset('public/frontEnd/')}}/js/jquery.ntm.js"></script>
<!-- jquery.ntm.js -->
<script src="{{asset('public/frontEnd/')}}/js/jquery.nice-select.min.js"></script>
<!-- jquery.nice-select.min.js -->
<script src="{{asset('public/frontEnd/')}}/js/script.js"></script>
<!-- custom script -->
<script src="{{asset('public/backEnd/')}}/dist/js/toastr.min.js"></script>
<!-- Toastr -->
{!! Toastr::message() !!}
<script>
	$(document).ready(function(){
		$('.addDiv').click(function(){
			document.getElementById('location-ads').classList.add('new-height');
			document.getElementById('addDiv').style="display:none";
			document.getElementById('removeDiv').style="display:block";
		});
		$('.removeDiv').click(function(){
			document.getElementById('location-ads').classList.remove('new-height');
			document.getElementById('removeDiv').style="display:none";
			document.getElementById('addDiv').style="display:block";
		});
	});
</script>
<script type="text/javascript">
        $('#category').change(function(){
        // alert('data');
        var ajaxId = $(this).val();    
        if(ajaxId){
            // alert('in ajaxId');
            $.ajax({
               type:"GET",
               url:"{{url('search-category')}}?category_id="+ajaxId,
               success:function(res){               
                if(res){
                    $("#subcategory").empty();
                    $("#subcategory").append('<option>Select Subcategory</option>');
                    $.each(res,function(key,value){
                        $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#subcategory").empty();
                   $("#subcategory").append('<option>Select Subcategory</option>');
                }
               }
            });
        }else{
            $("#subcategory").empty();
            $("#subcategory").append('<option>Select Subcategory</option>');
        }      
       });
        // District Find
        $('#division').change(function(){
            // alert('data');
            var ajaxId = $(this).val();    
            if(ajaxId){
                // alert('in ajaxId');
                $.ajax({
                   type:"GET",
                   url:"{{url('search-district')}}?division_id="+ajaxId,
                   success:function(res){               
                    if(res){
                        $("#district").empty();
                        $("#district").append('<option>District</option>');
                        $.each(res,function(key,value){
                            $("#district").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#district").empty();
                       $("#district").empty().append('<option>District</option>');;
                    }
                   }
                });
            }else{
                $("#district").empty();
                $("#district").append('<option>District</option>');;
            }      
       });
        // Thana Find
        $('#district').change(function(){
            // alert('data');
            var ajaxId = $(this).val();    
            if(ajaxId){
                // alert('in ajaxId');
                $.ajax({
                   type:"GET",
                   url:"{{url('search-thana')}}?dist_id="+ajaxId,
                   success:function(res){               
                    if(res){
                        $("#thana").empty();
                        $("#thana").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#thana").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#thana").empty();
                       $("#thana").empty().append('<option>Select</option>');;
                    }
                   }
                });
            }else{
                $("#thana").empty();
                $("#thana").append('<option>Select</option>');;
            }      
       });
        // Union Find
        $('#thana').change(function(){
            // alert('data');
            var ajaxId = $(this).val();    
            if(ajaxId){
                // alert('in ajaxId');
                $.ajax({
                   type:"GET",
                   url:"{{url('search-union')}}?thana_id="+ajaxId,
                   success:function(res){               
                    if(res){
                        $("#union").empty();
                        $("#union").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#union").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#union").empty();
                       $("#union").empty().append('<option>Select</option>');;
                    }
                   }
                });
            }else{
                $("#union").empty();
                $("#union").append('<option>Select</option>');;
            }      
       });
        // city
 </script>
   <script type="text/javascript">
        $(document).ready(function() {
          $(".btn-success").click(function(){ 
              var html = $(".clone").html();
              $(".increment").after(html);
          });
          $("body").on("click",".btn-danger",function(){ 
              $(this).parents(".control-group").remove();
          });

        });
        // 
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.demo').ntm();
    });
</script>
<script>
    $('.dslider').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        autoplay: true,
        nav: true,
        mouseDrag: true,
        touchDrag: false,
        autoplayHoverPause: false,
        margin: 0,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        
    });
    //   slider end
    $('.similerad').owlCarousel({
        items: 2,
        loop: true,
        dots: true,
        autoplay: true,
        nav: true,
        mouseDrag: true,
        touchDrag: false,
        autoplayHoverPause: false,
        margin: 20,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],  
    });
    //   slider end
</script>

<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("mobile-chat-phon").style.bottom = "0";
  } else {
    document.getElementById("mobile-chat-phon").style.bottom = "-50px";
  }
  prevScrollpos = currentScrollPos;
}

</script>



<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5edb90ac2b31b3f0"></script>

</body>
</html>