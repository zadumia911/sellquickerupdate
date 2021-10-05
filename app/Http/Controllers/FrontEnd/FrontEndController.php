<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Session;
use App\News;
use App\Customer;
use App\Advertisment;
use App\Category;
use App\Subcategory;
use App\Createpage;
use App\Division;
use App\District;
use App\Thana;
use App\Union;
use App\Banner;
class FrontEndController extends Controller
{
	public function searchcategory(Request $request){
        $subcategory = DB::table("subcategories")
            ->where("category_id",$request->category_id)
            ->pluck('subcategoryName','id');
            return response()->json($subcategory);
     }

    public function searchdistrict(Request $request){
     $districts = DB::table("districts")
     ->where("division_id",$request->division_id)
     ->pluck('dist_name','id');
	 return response()->json($districts);
	}
    public function searchthana(Request $request){
     $thana = DB::table("thanas")
     ->where("district_id",$request->dist_id)
     ->pluck('thana_name','id');
     return response()->json($thana);
    }
    public function searchunion(Request $request){
     $union = DB::table("unions")
     ->where("thana_id",$request->thana_id)
     ->pluck('union_name','id');
     return response()->json($union);
    }

    public function index(){
        $homecategories = Category::where('status',1)->limit(9)->get();
        return view('frontEnd.index',compact('homecategories'));
    }
     public function category($slug,Request $request){

        $breadcrumb=Category::where('slug',$slug)->first();
        $subcategories=Subcategory::where('category_id',$breadcrumb->id)->with('ads')->get();
        if($breadcrumb){
        $currentdata=Carbon::now()->format('Y-m-d');

        if($request->filter){
            if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                ->where('membership',1)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }else{
                $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                 ->where('membership',2)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }
        }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->paginate(25);
        }
        $sort = $request->sort;
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.category',compact('advertisments','breadcrumb','subcategories','sort','filter'));
        }else{
            return redirect('404');
        }
    }
     public function homesearch(Request $request){
        $breadcrumb=Category::where('id',$request->category)->first();
        $keyword = $request->keyword;
        if($breadcrumb!=NULL){
            $subcategories=Subcategory::where('category_id',$breadcrumb->id)->get();
            
        }else{
           $subcategories = NULL;  
        }
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where(['advertisments.status'=>1,'advertisments.request'=>1,'advertisments.category_id'=>$breadcrumb->id])
                ->where('advertisments.membership',1)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }else{
                $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
               ->where(['advertisments.status'=>1,'advertisments.request'=>1,'advertisments.category_id'=>$breadcrumb->id])
                ->where('advertisments.membership',2)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }
        }elseif($request->location && $request->category){
            // return "location and category";
            $advertisments= DB::table('advertisments')
            ->join('categories','advertisments.category_id','=','categories.id')
            ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
            ->join('divisions','advertisments.division_id','=','divisions.id')
            ->join('districts','advertisments.dist_id','=','districts.id')
            ->join('customers','advertisments.customer_id','=','customers.id')
            ->where(['advertisments.status'=>1,'advertisments.request'=>1])
             ->where('advertisments.category_id',$breadcrumb->id)
             ->where('advertisments.dist_id',$request->location)
              ->where('advertisments.title','LIKE','%'.$keyword."%")
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }elseif($request->location){
            return "location";
            $advertisments= DB::table('advertisments')
            ->join('categories','advertisments.category_id','=','categories.id')
            ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
            ->join('divisions','advertisments.division_id','=','divisions.id')
            ->join('districts','advertisments.dist_id','=','districts.id')
            ->join('customers','advertisments.customer_id','=','customers.id')
            ->where(['advertisments.status'=>1,'advertisments.request'=>1])
             ->where('advertisments.dist_id',$request->location)
             ->where('advertisments.title','LIKE','%'.$keyword."%")
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }elseif($request->category){
            $advertisments= DB::table('advertisments')
            ->join('categories','advertisments.category_id','=','categories.id')
            ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
            ->join('divisions','advertisments.division_id','=','divisions.id')
            ->join('districts','advertisments.dist_id','=','districts.id')
            ->join('customers','advertisments.customer_id','=','customers.id')
            ->where(['advertisments.status'=>1,'advertisments.request'=>1])
             ->where('advertisments.category_id',$breadcrumb->id)
             ->where('advertisments.title','LIKE','%'.$keyword."%")
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }else{
            $advertisments= DB::table('advertisments')
            ->join('categories','advertisments.category_id','=','categories.id')
            ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
            ->join('divisions','advertisments.division_id','=','divisions.id')
            ->join('districts','advertisments.dist_id','=','districts.id')
            ->join('customers','advertisments.customer_id','=','customers.id')
            ->where(['advertisments.status'=>1,'advertisments.request'=>1])
            ->where('advertisments.title','LIKE','%'.$keyword."%")
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }
        $sort = $request->sort;
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.searchads',compact('advertisments','subcategories','breadcrumb','sort','filter'));
    }
     public function subcategory($catslug,$subslug,Request $request){
        $categoryname=Category::where('slug',$catslug)->first();
        $breadcrumb=Subcategory::where('slug',$subslug)->first();
        $subcategories=Subcategory::where('category_id',$categoryname->id)->get();
        if($breadcrumb){
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
                ->where('membership',1)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }else{
                $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
                ->where('membership',2)
                ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }
        }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->paginate(25);
            // advertisment
        }
        $sort = $request->sort;
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.subcategory',compact('advertisments','breadcrumb','categoryname','subcategories','sort','filter'));
        }else{
            return redirect('404');
        }
    }
    public function allcategory(){
        $allcategory = Category::where('status',1)->get();
        return view('frontEnd.layouts.pages.allcategory',compact('allcategory','breadcrumb'));
    }
    public function locationads($slug,Request $request){
        $find_division = Division::where('slug',$slug)->first();
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= Advertisment::where('status',1)
                ->where('request',1)
                 ->where('membership',1)
                ->where('division_id',$find_division->id)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }else{
                $advertisments= Advertisment::where('status',1)
                ->where('request',1)
                ->where('membership',2)
                ->where('division_id',$find_division->id)
                ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }
        }else{
            $advertisments= Advertisment::where('status',1)
            ->where('request',1)
            ->where('division_id',$find_division->id)
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->paginate(25);
            // advertisment
        }
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.locationads',compact('advertisments','find_division','filter'));
    }
    public function thana_ads($division,$district,$thana,Request $request){
        $finddivision = Division::where('slug',$division)->first();
        $finddistrict = District::where('slug',$district)->first();
        $findthana = Thana::where('slug',$thana)->first();
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                 ->where('customers.membership',1)
                ->where('advertisments.thana_id',$thana->id)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }else{
                $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                 ->where('customers.membership',2)
                ->where('advertisments.thana_id',$thana->id)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }
        }else{
            $advertisments= DB::table('advertisments')
           ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                ->where('advertisments.thana_id',$findthana->id)
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.thanaads',compact('advertisments','findthana','filter','finddivision','finddistrict'));
    }
    public function union_ads($division,$district,$thana,$union,Request $request){
        $finddivision = Division::where('slug',$division)->first();
        $finddistrict = District::where('slug',$district)->first();
        $findthana = Thana::where('slug',$thana)->first();
        $findunion = Union::where('slug',$union)->first();
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                 ->where('customers.membership',1)
                ->where('advertisments.thana_id',$findunion->id)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }else{
                $advertisments= DB::table('advertisments')
                ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                 ->where('customers.membership',2)
                ->where('advertisments.thana_id',$findunion->id)
                 ->where('advertisments.adsduration','>=',$currentdata)
                ->orderBy('advertisments.id','DESC')
                ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
                ->paginate(25);
            }
        }else{
            $advertisments= DB::table('advertisments')
           ->join('categories','advertisments.category_id','=','categories.id')
                ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
                ->join('divisions','advertisments.division_id','=','divisions.id')
                ->join('districts','advertisments.dist_id','=','districts.id')
                ->join('thanas','advertisments.thana_id','=','thanas.id')
                ->join('customers','advertisments.customer_id','=','customers.id')
                ->where('advertisments.status',1)
                ->where('advertisments.request',1)
                ->where('advertisments.thana_id',$findthana->id)
             ->where('advertisments.adsduration','>=',$currentdata)
            ->orderBy('advertisments.id','DESC')
            ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as divi_name','districts.dist_name','customers.membership')
            ->paginate(25);
            // advertisment
        }
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.unionads',compact('advertisments','findthana','filter','finddivision','finddistrict','findunion'));
    }
    public function allads(Request $request){
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter){
            if($request->filter==1){
            $advertisments= Advertisment::where('status',1)
                ->where('request',1)
                ->where('membership',1)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
                
                $premiumadvertisments= Advertisment::where('status',1)
                ->where('request',1)
                ->where('premium',2)
                ->where('membership',1)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }else{
                $advertisments= Advertisment::where('status',1)
                ->where('request',1)
                ->where('membership',2)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
                
                $premiumadvertisments= Advertisment::where('status',1)
                ->where('request',1)
                ->where('premium',2)
                ->where('membership',2)
                 ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->paginate(25);
            }
        }else{
            $advertisments= Advertisment::where('status',1)
            ->where('request',1)
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->paginate(25);
            
            $premiumadvertisments= Advertisment::where('status',1)
            ->where('request',1)
            ->where('premium',2)
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->paginate(25);
            // advertisment
            // advertisment
        }
        $filter = $request->filter;
        
        return view('frontEnd.layouts.pages.allads',compact('advertisments','filter','premiumadvertisments'));
    }
    public function searchproduct(Request $request){
        $currentdata=Carbon::now()->format('Y-m-d');
        $advertisments= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
         ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->join('customers','advertisments.customer_id','=','customers.id')
        ->where(['advertisments.status'=>1,'advertisments.category_id'=>$request->category,'advertisments.subcategory_id'=>$request->location])
        ->where('advertisments.adsduration','>=',$currentdata)
        ->where('advertisments.request',1)
        ->select('advertisments.*','categories.name as catname','areas.name as areaName','subareas.subareaName','customers.membership')
        ->orderBy('advertisments.id','DESC')
        ->paginate(20);
        return $advertisments;
        return view('frontEnd.layouts.pages.searchproduct',compact('advertisments'));
    }
     public function details($id,$slug){
        $currentdata=Carbon::now()->format('Y-m-d');
        $adsdetails= Advertisment::where('adsduration','>=',$currentdata)
        ->where('status',1)
        ->first();
        if($adsdetails){
        return view('frontEnd.layouts.pages.details',compact('adsdetails'));
        }else{
            return redirect('404');
        }
    }

    public function footerpage($slug){
        $content = Createpage::where('slug',$slug)->limit(1,0)->get();
        return view('frontEnd.layouts.pages.footerpage',compact('content'));
    }
    public function contact(){
        return view('frontEnd.layouts.pages.contact');
    }
    public function support(){
        return view('frontEnd.layouts.pages.support');
    }
}
