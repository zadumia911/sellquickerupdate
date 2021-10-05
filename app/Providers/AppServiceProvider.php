<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Customer;
use App\Division;
use App\District;
use App\Thana;
use App\Union;
use App\Logo;
use App\Pagecategory;
use App\Advertisment;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $categories = Category::where('status',1)->get();
        view()->share('categories',$categories);
        // categories
        $faveicon = Logo::where(['status'=>1,'type'=>3])->limit(1,0)->get();
        view()->share('faveicon',$faveicon);
        // wlogo
        $wlogo = Logo::where(['status'=>1,'type'=>1])->limit(1,0)->get();
        view()->share('wlogo',$wlogo);
        // wlogo
        $dlogo = Logo::where(['status'=>1,'type'=>2])->limit(1,0)->get();
        view()->share('dlogo',$dlogo);
        // dlogo
        $divisions = Division::where('status',1)->get();
        view()->share('divisions',$divisions);
        // Division
        $districts = District::where('status',1)->get();
        view()->share('districts',$districts);
        // District
        $thanas = Thana::where('status',1)->get();
        view()->share('thanas',$thanas);
        // area
        $unions = Union::where('status',1)->get();
        view()->share('unions',$unions);
        // area
        $aboutcompanies = Pagecategory::where(['menu_id'=>1,'status'=>1])->get();
        view()->share('aboutcompanies',$aboutcompanies);
        // aboutcompanies
        $adsimage = DB::table('adsimages')
        ->join('advertisments','adsimages.ads_id','=','advertisments.id')
        ->select('advertisments.title','adsimages.*')
        ->orderBy('adsimages.id','DESC')
        ->get();
         view()->share('adsimage',$adsimage);
         
         // adsimage
        $customerslist=Customer::get();
        view()->share('customerslist',$customerslist);
        $newadsrequest= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
         ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->join('customers','advertisments.customer_id','=','customers.id')
        ->where('advertisments.status',0)
        ->where('advertisments.request',0)
        ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divisionname','districts.dist_name','customers.name as customername','customers.email','customers.phone','customers.image as customerimage','customers.id as customerId')
        ->get();
        view()->share('newadsrequest',$newadsrequest);
        // request new ads
        
        $updateadsrequest= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
        ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->join('customers','advertisments.customer_id','=','customers.id')
        ->where('advertisments.status',1)
        ->where('advertisments.request',0)
        ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divisionname','districts.dist_name','customers.name as customername','customers.email','customers.phone','customers.image as customerimage','customers.id as customerId')
        ->get();
        view()->share('updateadsrequest',$updateadsrequest);
        // request new ads
        
        $allads= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
        ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->join('customers','advertisments.customer_id','=','customers.id')
        ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divisionname','districts.dist_name','customers.name as customername','customers.email','customers.phone','customers.image as customerimage','customers.id as customerId')
        ->get();
        view()->share('allads',$allads);
        // request new ads
        
        $membershiprequest = Customer::where('membership',3)->get();
        view()->share('membershiprequest',$membershiprequest);
         // request membership
         
        $cancelshiprequest = Customer::where('membership',2)->get();
        view()->share('cancelshiprequest',$cancelshiprequest);
        // request membership cancel
        
        $allmembership = Customer::orWhere('membership',1)->orWhere('membership',2)->orWhere('membership',3)->get();
        view()->share('allmembership',$allmembership);
        // request membership cancel
        
        $premiumadsquantity = Advertisment::where('premium',2)->get();
        view()->share('premiumadsquantity',$premiumadsquantity);
        // request membership cancel
    }
}
