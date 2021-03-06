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
         if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                ->where('version',1)
                ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->with('image')
                ->paginate(25);
            }elseif($request->filter==2){
                $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                ->where('version',2)
                 ->where('adsduration','>=',$currentdata)
                ->with('image')
                ->paginate(25);
            }elseif($request->sort==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==3){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
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
        $keyword = $request->keyword;
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter==1){
               $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                ->where('version',1)
                ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->with('image')
                ->paginate(25);
            }elseif($request->filter==2){
                $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
                ->where('version',2)
                 ->where('adsduration','>=',$currentdata)
                ->with('image')
                ->paginate(25);
            }elseif($request->sort==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==3){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'category_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
            ->where('title','LIKE','%'.$keyword."%")
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
        }
        $sort = $request->sort;
        $filter = $request->filter;
        $breadcrumb = '';
        return view('frontEnd.layouts.pages.searchads',compact('advertisments','sort','filter','breadcrumb'));
    }
     public function subcategory($catslug,$subslug,Request $request){
        $categoryname=Category::where('slug',$catslug)->first();
        $breadcrumb=Subcategory::where('slug',$subslug)->first();
        $subcategories=Subcategory::where('category_id',$categoryname->id)->get();
        if($breadcrumb){
        $currentdata=Carbon::now()->format('Y-m-d');
       if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
                ->where('version',1)
                ->where('adsduration','>=',$currentdata)
                ->orderBy('id','DESC')
                ->with('image')
                ->paginate(25);
            }elseif($request->filter==2){
                $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
                ->where('version',2)
                 ->where('adsduration','>=',$currentdata)
                ->with('image')
                ->paginate(25);
            }elseif($request->sort==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==3){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'subcategory_id'=>$breadcrumb->id])
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
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
        if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
            ->where('version',1)
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
        }elseif($request->filter==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
            ->where('version',2)
             ->where('adsduration','>=',$currentdata)
            ->with('image')
            ->paginate(25);
        }elseif($request->sort==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==3){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1,'division_id'=>$find_division->id])
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
        }
        $filter = $request->filter;
        $sort   = $request->sort;
        return view('frontEnd.layouts.pages.locationads',compact('advertisments','find_division','filter','sort'));
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
                ->with('image')
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
                ->with('image')
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
            ->with('image')
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
                ->with('image')
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
                ->with('image')
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
            ->with('image')
            ->paginate(25);
            // advertisment
        }
        $filter = $request->filter;
        return view('frontEnd.layouts.pages.unionads',compact('advertisments','findthana','filter','finddivision','finddistrict','findunion'));
    }
    public function allads(Request $request){
        $currentdata=Carbon::now()->format('Y-m-d');
        if($request->filter==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
            ->where('version',1)
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
        }elseif($request->filter==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
            ->where('version',2)
             ->where('adsduration','>=',$currentdata)
            ->with('image')
            ->paginate(25);
        }elseif($request->sort==1){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==2){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('id','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==3){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','ASC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }elseif($request->sort==4){
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
             ->where('adsduration','>=',$currentdata)
            ->orderBy('price','DESC')
            ->with('image')
            ->paginate(25);
         }else{
            $advertisments= Advertisment::where(['status'=>1,'request'=>1])
            ->where('adsduration','>=',$currentdata)
            ->orderBy('id','DESC')
            ->with('image')
            ->paginate(25);
        }
        $sort = $request->sort;
        $filter = $request->filter;
        
        return view('frontEnd.layouts.pages.allads',compact('advertisments','filter','sort'));
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
