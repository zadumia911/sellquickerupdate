<?php

namespace App\Http\Controllers\superadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
class DashboardController extends Controller
{
    public function index(){
    	return view('backEnd.superadmin.dashboard');
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
