<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use Session;
use App\Post;
use App\Devision;
use App\Destrict;
use App\Adreport;
use App\Membershipform;
use Mail;
use File;
use DB;
class CustomerController extends Controller
{

	public function validCustomer(){
		$customerCheck=Session::get('customerId');
		$customerInfo=Customer::find($customerCheck);
		return $customerInfo;
	}

    public function register(){
    	return view('frontEnd.customer.register');
    }
    // register panel
    public function storecustomer(Request $request){
    	$this->validate($request,[
    		'name' => 'required',
    		'phone' => 'required|unique:customers',
    		'email' => 'required|unique:customers',
    		'password' => 'required',
    		'confirmed' => 'required_with::password|same:password',
    	]);
    	$verify = rand(1111,9999);
    	$store_data           	  = 	new Customer();
        $store_data->name         =     $request->name;
    	$store_data->slug      	  = 	strlower(preg_replace('/\s+/u', '-', trim($request->name)));
    	$store_data->email  	  = 	$request->email;
    	$store_data->phone  	  = 	$request->phone;
    	$store_data->agree  	  = 	1;
    	$store_data->verify  	  = 	0;
    	$store_data->password  	  = 	bcrypt($request->password);
    	$store_data->save();

    	// verify code send to customer mail
    
    	// customer id put
    	$customerId=$store_data->id;
    	Session::put('customerId',$customerId);
    	Toastr::success('message', 'Your information add successfully!');
    	return view('frontEnd.customer.dashboard');
    }
    // customer register

    public function login(){
    	return view('frontEnd.customer.login');
    }
    // login from
    public function userlogin(Request $request){
        $this->validate($request,[
            'phoneOremail' => 'required',
            'password' => 'required',
        ]);
    	$customerCheck =Customer::orWhere('email',$request->phoneOremail)
       ->orWhere('phone',$request->phoneOremail)
       ->first();
       // return $customerCheck;
        if($customerCheck){
        	if($customerCheck->status == 0){
	          Toastr::error('message', 'Opps! your account has been suspends');
	           return redirect()->back();
	       }else{
	       	if(password_verify($request->password,$customerCheck->password)){
	        		$customerId = $customerCheck->id;
                    Session::put('customerId',$customerId);
                    Toastr::success('congratulation you login successfully', 'success!');
	        		return redirect('/customer/0/control-panel/dashboard');
	        	
	       	}else{
        	  Toastr::error('message', 'Opps! your password wrong');
          	  return redirect()->back();
	       	}

        	 }
        }else{
        	Toastr::error('message', 'Sorry! You have no account');
        	return redirect()->back();
        }
       
    }
    public function forgetpassword(){
        return view('frontEnd.customer.forgetpassword');
    }
    public function forgetpassemailcheck(Request $request){
        $this->validate($request,[
            'email'=>'required',
        ]);
       $checkEmail = Customer::where('email',$request->email)->first();
      if($checkEmail){
        $passResetToken=rand(111111,999999);
        $checkEmail->passResetToken=$passResetToken;
        $checkEmail->save();

        // verify code send to customer mail
        $data = array(
         'contact_email' => $request->email,
         'passResetToken' => $passResetToken,
        );
        $send = Mail::send('frontEnd.emails.forgetpassword', $data, function($textmsg) use ($data){
         $textmsg->from('info@hatbodol.com');
         $textmsg->to($data['contact_email']);
         $textmsg->subject('Forget password code');
        });
        Toastr::success('We are send a forget password verify code in your email','Success');
        Session::put('intcustomerId',$checkEmail->id);
        return redirect('customer/forget-password/reset');
      }else{
        Toastr::error('Your email address not found','Opps');
        return redirect()->back();
      }
    }
    public function passresetpage(){
       if(Session::get('intcustomerId')){
        return view('frontEnd.customer.passwordreset');
        }else{
           Toastr::error('Your request process rong','Opps!');
           return redirect('customer/forget-password'); 
        }
    }
    public function fpassreset(Request $request){
        $this->validate($request,[
            'verifycode'=>'required',
            'newpassword'=>'required',
        ]);
       $memberInfo = Customer::find(Session::get('intcustomerId'));
      if($memberInfo->passResetToken == $request->verifycode){
        $memberInfo->password=bcrypt(request('newpassword'));
        $memberInfo->passResetToken=NULL;
        $memberInfo->save();
        Toastr::success('Your password reset successfully','Success');
        Session::forget('intcustomerId');
        Session::put('customerId',$memberInfo->id);
        return redirect('/customer/0/control-panel/dashboard');
      }else{
        Toastr::error('Your verified code not match','Opps');
        return redirect()->back();
      }
    }

    
    // login from
    public function resetpass(Request $request){
        $this->validate($request,[
            'phoneOremail' => 'required',
            'password' => 'required',
        ]);
        $customerCheck =Customer::orWhere('email',$request->phoneOremail)
       ->orWhere('phone',$request->phoneOremail)
       ->first();
       // return $customerCheck;
        if($customerCheck){
            if($customerCheck->status == 0){
              Toastr::error('message', 'Opps! your account has been suspends');
               return redirect()->back();
           }else{
            if(password_verify($request->password,$customerCheck->password)){
                    $customerId = $customerCheck->id;
                    Session::put('customerId',$customerId);
                    Toastr::success('congratulation you login successfully', 'success!');
                    return redirect('/customer/0/control-panel/dashboard');
                
            }else{
              Toastr::error('message', 'Opps! your password wrong');
              return redirect()->back();
            }

             }
        }else{
            Toastr::error('message', 'Sorry! You have no account');
            return redirect()->back();
        }
       
    }
    // customer login 
    
    // account verify
    public function caccountverify(Request $request){
        if(Session::get('customerId') !=NULL){
    		$findcustomer=Customer::find(Session::get('customerId'));
    		$verifyToken = mt_rand(000000,999999);
    		$findcustomer->verifyToken =$verifyToken;
    		$findcustomer->save();
    		Session::put('verifyaccess',$findcustomer->id);
        	$data = array(
             'email' => $findcustomer->email,
             'verifyToken' => $verifyToken,
            );
            // return $data;
            $send = Mail::send('frontEnd.emails.accountverify', $data, function($textmsg) use ($data){
             $textmsg->from('info@hatbodol.com');
             $textmsg->to($data['email']);
             $textmsg->subject('Account Verification');
            });
            Toastr::success('Please check your mail for email verify token', 'Success!');
            return redirect('customer/0/account/verification'); 
        }else{
           return redirect('/customer/login'); 
        }
    }
     public function accountverifyPage(){
        $customerCheck=Session::get('customerId');
        if($customerCheck!=NULL && Session::get('verifyaccess')!=NULL){
    		return view('frontEnd.customer.accountverify');
        }else{
           return redirect('/customer/login'); 
        }
    }
    public function verification(Request $request){
        $vfindcustomer=Customer::find(Session::get('customerId'));
        if($vfindcustomer->verifyToken==$request->token){
           $vfindcustomer->verifyToken = NULL;
           $vfindcustomer->verify = 1;
           $vfindcustomer->save();
           Session::forget('verifyaccess');
           return redirect('/customer/0/control-panel/dashboard');
        }else{
            Toastr::error('Your token is wrong', 'Opps!');
            return redirect('customer/0/account/verification'); 
        }
    }
     public function editprofile(){
        $customerCheck=Session::get('customerId');
        if($customerCheck){
    		$edit_data=Customer::find(Session::get('customerId'));
    		return view('frontEnd.customer.editprofile',compact('edit_data'));
        }else{
           return redirect('/customer/login'); 
        }
    }
    public function dashboard(){
		if($this->validCustomer()){
		return view('frontEnd.customer.dashboard');
		}else{
    		Toastr::error('Please Login First', 'Opps!');
			return redirect('/customer/login');

		}
    }
    // customer dashboard

    public function profileUpdate(Request $request){
    	$update_data=Customer::find(Session::get('customerId'));
    	$update_image = $request->file('image');
        if($update_image) {
           $file = $request->file('image');
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/customer/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }
    	$update_data->name     		 = 	$request->name;
        $update_data->slug           =  preg_replace('/\s+/u', '-', trim($request->name));
    	$update_data->phone  	  	 = 	$request->phone;
    	$update_data->email  	  	 = 	$request->email;
    	$update_data->city  	  	 = 	$request->city;
    	$update_data->state  	  	 = 	$request->state;
    	$update_data->postal  	  	 = 	$request->postal;
    	$update_data->address  	  	 = 	$request->address;
    	$update_data->facebook  	 = 	$request->facebook;
    	$update_data->linkedin  	 = 	$request->linkedin;
    	$update_data->youtube  		 = 	$request->youtube;
    	$update_data->website  		 = 	$request->website;
    	$update_data->twitter  		 = 	$request->twitter;
    	$update_data->image  		 = 	$fileUrl;
    	$update_data->about  		 = 	$request->about;
    	$update_data->save();
        Toastr::success('message', 'Customer Info Update successfully!');
        return redirect()->back();
    }

    // customer profile update

    public function membership(){
        return view('frontEnd.customer.membership');
    }

    public function membershiprequest(Request $request){
        
        $requestmemberform= new Membershipform();
        $requestmemberform->customerId = Session::get('customerId');
        $requestmemberform->shopname = $request->shopname;
        $requestmemberform->shopholdername = $request->shopholdername;
        $requestmemberform->shopholderphone = $request->shopholderphone;
        $requestmemberform->shopaddress = $request->shopaddress;
        $requestmemberform->save();
        
        $requestmember=Customer::find(Session::get('customerId'));
        $requestmember->membership = 3;
        $requestmember->save();
        Toastr::success('Your request send successfully. Please wait it activate', 'Thank you!');
        return redirect()->back();
    }
    
    public function membershipcancel(Request $request){
        $cancelmember=Customer::find($request->customer);
        $cancelmember->membership = 2;
        $cancelmember->save();
        Toastr::success('Your membership cancel request send successfully. Please wait approval it.', 'Thank you!');
        return redirect()->back();
    }

    public function logout(){
        Session::flush();
        Toastr::success('You are logout successfully', 'Logout!');
        return redirect('/');
    }
    // customer logout
    
    public function allreports(){
         $show_datas = DB::table('adreports')
        ->join('advertisments','adreports.ad_id','=','advertisments.id')
        ->select('adreports.*','advertisments.title')
        ->where('adreports.reporter_id',Session::get('customerId'))
        ->get();
        return view('frontEnd.customer.allreports',compact('show_datas'));
    }
    
    
    
    
}
