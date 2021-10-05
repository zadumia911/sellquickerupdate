<?php

namespace App\Http\Controllers\superadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\User;
use App\Advertisment;
use today;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){

    	$alluser = User::count();
    	$newads  = Advertisment::where(['request'=>0, 'status'=>0])->count();
    	$updateads  = Advertisment::where(['request'=>0, 'status'=>1])->count();
    	$premiumads  = Advertisment::where('premium',2)->count();
    	$adsall  = Advertisment::where(['request'=>1, 'status'=>1])->count();
    	$membeReqeuest  = Customer::where('membership',3)->count();
    	$totalMember  = Customer::orWhere('membership',1)->orWhere('membership',2)->orWhere('membership',3)->count();
    	$cancelMember  = Customer::where('membership',2)->count();
    	$todayAds  = Advertisment::whereDate('created_at',Carbon::today())->count();
    	$totalcustomer  = Customer::count();

    	return view('backEnd.superadmin.dashboard',compact('alluser','newads','updateads','premiumads','adsall','membeReqeuest','totalMember','cancelMember','todayAds','totalcustomer'));


    }
    public function cinactive(Request $request){
	    $active_data         =   Customer::find($request->hidden_id);
	    $active_data->status =  0;
	    $active_data->save();
	    Toastr::success('message', 'customer inactive successfully!');
	    	return redirect()->back();   
		}

		public function cactive(Request $request){
	    $active_data         =   Customer::find($request->hidden_id);
	    $active_data->status =  1;
	    $active_data->save();
	    Toastr::success('message', 'customer active successfully!');
	   	return redirect()->back();     
		}

		public function destroy(Request $request){
        $deleteId = Customer::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'customer  delete successfully!');
     	  return redirect()->back();
    	}

    	// membership requst
    	public function membershiprequest(){
    		$membershiprequest = Customer::where('membership',3)->get();
    		return view('backEnd.customer.membershiprequest',compact('membershiprequest'));
    	}
	    public function acceptmembership(Request $request){
	        $requestmember=Customer::find($request->customer);
	        $requestmember->membership = 1;
	        $requestmember->save();
	        Toastr::success('Membership accesspt successfully.', 'Okey!');
	        return redirect()->back();
	    }
	    // membership cancel
	    public function cancelmembership(){
    		$cancelmembership = Customer::where('membership',2)->get();
    		return view('backEnd.customer.cancelmembership',compact('cancelmembership'));
    	}

	    public function cancelmemberrequest(Request $request){
	        $requestmember=Customer::find($request->customer);
	        $requestmember->membership = 0;
	        $requestmember->save();
	        Toastr::success('Membership cancel successfully.', 'Okey!');
	        return redirect()->back();
	    }
	    	// membership requst
    	public function allmembership(){
    		$allmembership = Customer::orWhere('membership',1)->orWhere('membership',2)->orWhere('membership',3)->get();
    		return view('backEnd.customer.allmembership',compact('allmembership'));
    	}



}
