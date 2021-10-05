<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace'=>'FrontEnd'], function(){
	 Route::get('/', 'FrontEndController@index');
	 Route::get('/category/{slug}/', 'FrontEndController@category');
     Route::get('/category/{catslug}/{subslug}', 'FrontEndController@subcategory');
     Route::get('home-search/', 'FrontEndController@homesearch');
     Route::get('/all-ads', 'FrontEndController@allads');
	 Route::get('/ads/{slug}/{id}', 'FrontEndController@subcategory');
	 Route::get('/details/{id}/{slug}', 'FrontEndController@details');
	 Route::get('/search-category','FrontEndController@searchcategory');
	 Route::post('/search/products','FrontEndController@searchproduct');
	 Route::get('/location/{slug}','FrontEndController@locationads');
     Route::get('/location/{division}/{district}/{thana}','FrontEndController@thana_ads');
     Route::get('/location/{division}/{district}/{thana}/{union}','FrontEndController@union_ads');
	 Route::get('/allcategory', 'FrontEndController@allcategory');
	 Route::get('/page/{slug}', 'FrontEndController@footerpage');
	 Route::get('/search-district','FrontEndController@searchdistrict');
     Route::get('/search-thana','FrontEndController@searchthana');
     Route::get('/search-union','FrontEndController@searchunion');
	 Route::get('/how-to-quick-sell','FrontEndController@quicksell');
     Route::get('/contact-us','FrontEndController@contact');
     Route::get('/support','FrontEndController@support');
    


});
 Route::post('message/visitor/to/publisher','EmailController@publisherEmail');
 Route::post('visitor/support/','EmailController@visitorsupport');
 Route::post('report/ad','EmailController@reportad');
  
 Route::group(['namespace'=>'Customer','prefix'=>'customer'], function(){
 // customer oparation
	Route::get('/register', 'CustomerController@register');
	Route::post('/register', 'CustomerController@storecustomer');
    Route::get('/login','CustomerController@login');
    Route::post('login','CustomerController@userlogin');
    Route::get('forget/password','CustomerController@forgetpassword');
    Route::post('forget-password','CustomerController@forgetpassemailcheck');
    Route::get('forget-password/reset','CustomerController@passresetpage');
    Route::post('forget-password/reset','CustomerController@fpassreset');

    Route::get('customer/0/control-panel/account-verify','CustomerController@accountverify');
    Route::get('/logout','CustomerController@logout');
    Route::get('/0/control-panel/dashboard','CustomerController@dashboard');
    Route::get('0/control-panel/edit','CustomerController@editprofile');
    Route::post('/0/control-panel/profile/update','CustomerController@profileUpdate');
    Route::get('ad/report-list/','CustomerController@allreports');
    
    // email Verification
    Route::post('auth/0/control-panel/account-verify','CustomerController@caccountverify');
    Route::get('/0/account/verification','CustomerController@accountverifyPage');
    Route::post('auth/customer/email/verification/check','CustomerController@verification');
    // Membership oparations 
    Route::get('/0/control-panel/membership-request','CustomerController@membership');
    Route::post('/0/control-panel/membership-request','CustomerController@membershiprequest');
    Route::post('/0/control-panel/membership-cancel','CustomerController@membershipcancel');

    // advertisment route here
    Route::get('/0/control-panel/manage-my-ads','AdsController@myads');
    Route::get('/0/control-panel/post-new-ads','AdsController@postads');
    Route::get('/0/control-panel/{id}/post-edit-ads','AdsController@editads');
    Route::post('/0/control-panel/ads-make-premium','AdsController@adsPremium');
    Route::get('/{slug}/0/control-panel/{id}/post-delete-ads','AdsController@deleteads');
    Route::post('/0/control-panel/post-new-ads','AdsController@adspublished');
    Route::post('/ads/published/update','AdsController@adsupdate');
    Route::get('/ads/image/delete/{id}','AdsController@adsimagedel');
    
});


 Route::group(['as'=>'superadmin.', 'prefix'=>'superadmin', 'namespace'=>'Superadmin','middleware'=>[ 'auth', 'superadmin']], function(){
 // superadmin dashboard
 Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
 // customer route
    Route::post('customer/inactive','DashboardController@cinactive');
    Route::post('customer/active','DashboardController@cactive');

    // user management section

    Route::get('/user/create', 'UserController@create');
    Route::post('/user/store', 'UserController@save');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/manage', 'UserController@manage');
    Route::post('/user/inactive', 'UserController@inactive');
    Route::post('/user/active', 'UserController@active');
    Route::post('/user/delete', 'UserController@destroy');
    
    
    // membership request
    Route::get('/customer/membership-request','DashboardController@membershiprequest');
    Route::post('customer/membership-accept','DashboardController@acceptmembership');
    Route::get('customer/membership-cancel','DashboardController@cancelmembership');
    Route::post('customer/membership-cancel','DashboardController@cancelmemberrequest');
    Route::get('customer/all-membership','DashboardController@allmembership');
});


Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin','middleware'=>['auth', 'admin']], function(){

 // admin dashboard
 Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
 	// Logo route here
    Route::get('/logo/create','LogoController@create');
    Route::post('/logo/store','LogoController@store');
    Route::get('/logo/manage','LogoController@manage');
    Route::get('/logo/edit/{id}','LogoController@edit');
    Route::post('/logo/update','LogoController@update');
    Route::post('/logo/inactive','LogoController@inactive');
    Route::post('/logo/active','LogoController@active');
    Route::post('/logo/delete','LogoController@destroy');
    
   // membership
    Route::get('membership/ads-limit/create','MembershipController@create');
    Route::post('membership/ads-limit/store','MembershipController@store');
    Route::get('membership/ads-limit/manage','MembershipController@manage');
    Route::get('membership/ads-limit/edit/{id}','MembershipController@edit');
    Route::post('membership/ads-limit/update','MembershipController@update');
    Route::post('membership/ads-limit/inactive','MembershipController@inactive');
    Route::post('membership/ads-limit/active','MembershipController@active');
        
    // news route
    Route::get('/news/create','NewsController@create');
    Route::post('/news/store','NewsController@store');
    Route::get('/news/manage','NewsController@manage');
    Route::get('/news/edit/{id}','NewsController@edit');
    Route::post('/news/update','NewsController@update');
    Route::post('/news/inactive','NewsController@inactive');
    Route::post('/news/active','NewsController@active');
    Route::post('/news/delete','NewsController@destroy');
    // ads manage route here
    Route::get('show/ads-new/request','AdsmanageController@requestnewads');
    Route::get('show/ads-update/request','AdsmanageController@requestupdateads');
    Route::get('show/ads-premium/request','AdsmanageController@requestpremiumads');
    Route::post('customer/premium-ads/acceptrequest','AdsmanageController@requestacceptpremiumads');
    Route::get('customer/ads/activation/{id}','AdsmanageController@activation');
    Route::get('customer/show/all-ads','AdsmanageController@allads');
    Route::post('customer/ads/published','AdsmanageController@published');
    Route::post('customer/ads/acceptrequest','AdsmanageController@acceptrequest');
    Route::post('customer/ads/unpublished','AdsmanageController@unpublished');
    Route::post('customer/ads/delete','AdsmanageController@destroy');
    Route::post('customer/ads/activation/save','AdsmanageController@activationsave');

});


Route::group(['as'=>'editor.', 'prefix'=>'editor', 'namespace'=>'Editor','middleware'=>['auth', 'editor']], function(){
 // editor dashboard
 	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
 	
    Route::get('banner/create','BannerController@create');
    Route::post('banner/store','BannerController@store');
    Route::get('banner/manage','BannerController@manage');
    Route::get('banner/edit/{id}','BannerController@edit');
    Route::post('banner/update','BannerController@update');
    Route::post('banner/inactive','BannerController@inactive');
    Route::post('banner/active','BannerController@active');
    Route::post('banner/delete','BannerController@destroy');
 	// category route
	Route::get('/category/create','CategoryController@create');
    Route::post('/category/store','CategoryController@store');
    Route::get('/category/manage','CategoryController@manage');
    Route::get('/category/edit/{id}','CategoryController@edit');
    Route::post('/category/update','CategoryController@update');
    Route::post('/category/inactive','CategoryController@inactive');
    Route::post('/category/active','CategoryController@active');

    // subcategory route
    Route::get('subcategory/create','SubcategoryController@create');
    Route::post('subcategory/save','SubcategoryController@store');
    Route::get('subcategory/manage','SubcategoryController@manage');
    Route::get('subcategory/edit/{id}','SubcategoryController@edit');
    Route::post('subcategory/update','SubcategoryController@update');
    Route::post('subcategory/inactive','SubcategoryController@inactive');
    Route::post('/subcategory/active','SubcategoryController@active');

     // area route
	Route::get('/division/create','DivisionController@create');
    Route::post('/division/store','DivisionController@store');
    Route::get('/division/manage','DivisionController@manage');
    Route::get('/division/edit/{id}','DivisionController@edit');
    Route::post('/division/update','DivisionController@update');
    Route::post('/division/inactive','DivisionController@inactive');
    Route::post('/division/active','DivisionController@active');

    // sub area
    Route::get('district/create','DistrictController@create');
    Route::post('district/save','DistrictController@store');
    Route::get('district/manage','DistrictController@manage');
    Route::get('district/edit/{id}','DistrictController@edit');
    Route::post('district/update','DistrictController@update');
    Route::post('district/inactive','DistrictController@inactive');
    Route::post('/district/active','DistrictController@active');

    // thana route
    Route::get('thana/create','ThanaController@create');
    Route::post('thana/save','ThanaController@store');
    Route::get('thana/manage','ThanaController@manage');
    Route::get('thana/edit/{id}','ThanaController@edit');
    Route::post('thana/update','ThanaController@update');
    Route::post('thana/inactive','ThanaController@inactive');
    Route::post('/thana/active','ThanaController@active');

    // union route
    Route::get('union/create','UnionController@create');
    Route::post('union/save','UnionController@store');
    Route::get('union/manage','UnionController@manage');
    Route::get('union/edit/{id}','UnionController@edit');
    Route::post('union/update','UnionController@update');
    Route::post('union/inactive','UnionController@inactive');
    Route::post('/union/active','UnionController@active');


    // Footer Page
    Route::get('/pagecategory/create','PagecategoryController@create');
    Route::post('/pagecategory/save','PagecategoryController@store');
    Route::get('/pagecategory/manage','PagecategoryController@manage');
    Route::get('/pagecategory/edit/{id}','PagecategoryController@edit');
    Route::post('/pagecategory/update','PagecategoryController@update');
    Route::post('/pagecategory/inactive','PagecategoryController@inactive');
    Route::post('//pagecategory/active','PagecategoryController@active');

    // Page Design
    Route::get('/createpage/create','CreatepageController@create');
    Route::post('/createpage/save','CreatepageController@store');
    Route::get('/createpage/manage','CreatepageController@manage');
    Route::get('/createpage/edit/{id}','CreatepageController@edit');
    Route::post('/createpage/update','CreatepageController@update');
    Route::post('/createpage/inactive','CreatepageController@inactive');
    Route::post('/createpage/active','CreatepageController@active');

    // counter route
    Route::get('/counter/create','CounterController@create');
    Route::post('/counter/store','CounterController@store');
    Route::get('/counter/manage','CounterController@manage');
    Route::get('/counter/edit/{id}','CounterController@edit');
    Route::post('/counter/update','CounterController@update');
    Route::post('/counter/unpublished','CounterController@unpublished');
    Route::post('/counter/published','CounterController@published');
    Route::post('/counter/delete','CounterController@destroy');
    
    // customer ads
     Route::get('customer/allads/{slug}/{id}','DashboardController@allads');
     
     // customer ads
     Route::get('ad/reports/','DashboardController@allreports');
     Route::post('/reports/unpublished','DashboardController@unpublished');
     Route::post('/reports/published','DashboardController@published');
     Route::post('/reports/delete','DashboardController@destroy');



});

 Route::group(['namespace'=>'Reports'], function(){
	// Repost functon
    Route::get('/editor/customer/list','ReportsController@customerlist');
});
 Route::group(['as'=>'author.', 'prefix'=>'author', 'namespace'=>'author','middleware'=>['auth', 'author']], function(){
 Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
