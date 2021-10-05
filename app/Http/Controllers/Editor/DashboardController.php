<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Advertisment;
use App\Adreport;
use DB;
class DashboardController extends Controller
{
    public function index(){
    	return view('backEnd.superadmin.dashboard');
    }
     public function allads($slug,$id){
    	$customerInfo=Customer::find($id);
        $customersads= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
        ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->join('customers','advertisments.customer_id','=','customers.id')
        ->where('advertisments.customer_id',$id)
        ->select('advertisments.*','categories.name as catname','subcategories.subcategoryName','divisions.name as division_name','districts.dist_name','customers.name as customername','customers.email as customeremail','customers.phone as customerphone','customers.email','customers.phone','customers.image as customerimage','customers.id as customerId')
        ->get();
        // return $customersads;
    	return view('backEnd.customer.customerads',compact('customersads','customerInfo'));
    }
    
    public function allreports(){
        $show_datas = DB::table('adreports')
        ->join('customers','adreports.reporter_id','=','customers.id')
        ->join('advertisments','adreports.ad_id','=','advertisments.id')
        ->select('adreports.*','customers.name','customers.name as reportername','customers.email as reporteremail','customers.phone as reporterphone','advertisments.title')
        ->get();
        
        return view('backEnd.customer.allreports',compact('show_datas'));
    }
    public function unpublished(Request $request){
        $unpublished_data           =   Adreport::find($request->hidden_id);
        $unpublished_data->status   =   2;
        $unpublished_data->save();
        Toastr::success('message', 'Report Canceled successfully!');
        return redirect()->back();  
    }
     public function published(Request $request){
        $published_data         =   Adreport::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Adreport Accept successfully!');
        return redirect()->back();   
    }
    
    public function destroy(Request $request){
        $deleteId = Adreport::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'Adreport  delete successfully!');
        return redirect()->back();
    }
    
    
    
}
