<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Advertisment;
use App\Adsimage;
use App\Post;
use App\Category;
use App\Subcategory;
use App\Division;
use App\District;
use DB;
use Session;
use Mail;
use File;
use Image;
class AdsController extends Controller
{
    
    public function validCustomer(){
        $customerCheck=Session::get('customerId');
        $customerInfo=Customer::find($customerCheck);
        return $customerInfo;
    }
    public function postads(){
        if($this->validCustomer()){
        return view('frontEnd.customer.postads');
        }else{
            Toastr::success('message', 'Login first!');
            return redirect('customer/login');
        }
    }
    public function adspublished(Request $request){
        // return $request->all();
        $this->validate($request,[
        'title'          => 'required',
        'category'       => 'required',
        'subcategory' => 'required',
        'division_id'           => 'required',
        'dist_id'          => 'required',
        'thana_id'          => 'required',
        'union_id'          => 'required',
        'brand'          => 'required',
        'phone'        => 'required',
        'version'        => 'required',
        'price'          => 'required',
        'image'      => 'required|max:7168',
        'description' => 'required',

    ]);
    
    $request_id= Advertisment::orderBy('id','DESC')->first();
    
    if($request_id!=NULL){
             $base1 = 1;
             $base = $request_id->id;
             $ads_id = $base1 + $base;
    }else{
            $base1 = 1;
            $base = 0;
            $ads_id = $base1 + $base;
    }
    $membership = Customer::where(['membership'=>1, 'id'=>Session::get('customerId')])->first();

    if($membership==NULL){
        $adrequest = 0;
        $status = 0;
        $duration = NULL;
    }else{
        $adrequest = 1;
        $status = 1;
        $duration = date('Y-m-d', strtotime('1 month'));
    }

    $store_data                       =     new Advertisment();
    $store_data->title                =     $request->title;
    $store_data->slug                 =     strtolower(preg_replace('/\s+/u', '-', trim($request->title)));
    $store_data->category_id          =     $request->category;
    $store_data->subcategory_id       =     $request->subcategory;
    $store_data->division_id          =     $request->division_id;
    $store_data->dist_id              =     $request->dist_id;
    $store_data->thana_id             =     $request->thana_id;
    $store_data->union_id             =     $request->union_id;
    $store_data->phone                =     $request->phone;
    $store_data->email                =     $request->email;
    $store_data->phone                =     $request->phone;
    $store_data->version              =     $request->version;
    $store_data->type                 =     $request->type;
    $store_data->brand                =     $request->brand;
    $store_data->model                =     $request->model;
    $store_data->edition              =     $request->edition;
    $store_data->feature              =     $request->feature;
    $store_data->price                =     $request->price;
    $store_data->full_address         =     $request->full_address;
    $store_data->adsduration          =     $duration;
    $store_data->request              =     $adrequest;
    $store_data->status               =     $status;
    $store_data->ads_id               =     $ads_id;
    $store_data->description          =     $request->description;
    $store_data->customer_id          =     Session::get('customerId');
    $store_data->save();

    $ads_id=$store_data->id;
    $images = $request->file('image');
    foreach($images as $image)
    {
       // image01 upload
         $name =  time().'-'.$image->getClientOriginalName();
         $uploadpath = 'public/uploads/advertisment/';
         $imageUrl = $uploadpath.$name; 
         $img=Image::make($image->getRealPath());
         $img->orientate();
         $width = 695; // your max width
         $height = 325; // your max height
         $img->height() > $img->width() ? $width=null : $height=null;
         $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        // paste another image
        // $watermark = 'public/frontEnd/images/watermark.png';
        // $img->insert($watermark,'bottom-right', 20, 20);
        $img->save($imageUrl);

         $proimage= new Adsimage();
         $proimage->ads_id = $ads_id;
         $proimage->image=$imageUrl;
         $proimage->save();
    }
    
    Toastr::success('message', 'Advertisment upload successfully!');
    return redirect('customer/0/control-panel/manage-my-ads');
    }

    public function myads(){
        if($this->validCustomer()){
    	$manageads= DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
        ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->where('advertisments.customer_id',Session::get('customerId'))
        ->orderBy('advertisments.id','DESC')
        ->select('advertisments.*','categories.name','subcategories.subcategoryName','divisions.name as division_name','districts.dist_name')
        ->get();
    	return view('frontEnd.customer.myads',compact('manageads'));
        }else{
            return redirect('customer/login');
        }
    }
    
    public function editads($id){
        $edit_data = DB::table('advertisments')
        ->join('categories','advertisments.category_id','=','categories.id')
        ->join('subcategories','advertisments.subcategory_id','=','subcategories.id')
        ->join('divisions','advertisments.division_id','=','divisions.id')
        ->join('districts','advertisments.dist_id','=','districts.id')
        ->where('advertisments.customer_id',Session::get('customerId'))
        ->select('advertisments.*','categories.name','subcategories.subcategoryName','divisions.name as division_name','districts.dist_name')
        ->where(['advertisments.id'=>$id])
        ->first();
        if($edit_data!=NULL){
        $category = Category::where('status','=','1')->get();
        $categoryId = Advertisment::find($id)->category_id;
        $subcategory = Subcategory::where('category_id','=',$categoryId)->get();
        $divisions = Division::where('status','=','1')->get();
        $division_id = Advertisment::find($id)->division_id;
        $district = District::where('division_id','=',$division_id)->get();
    	return view('frontEnd.customer.editads',compact('edit_data','category','subcategory','divisions','district'));
        }else{
            return redirect()->back();
        }

    }
    public function adsupdate(Request $request){
       $this->validate($request,[
        'title'          => 'required',
        'category'       => 'required',
        'phone'          => 'required',
        'version'        => 'required',
        'price'          => 'required',
        'description' => 'required',

    ]);
    $request_id= Advertisment::orderBy('id','DESC')->first();
    if($request_id!=NULL){
             $base1 = 1;
             $base = $request_id->id;
             $ads_id = $base1 + $base;
    }else{
            $base1 = 1;
            $base = 0;
            $ads_id = $base1 + $base;
    }


    $update_data = Advertisment::where(['id'=>$request->hidden_id,'customer_id'=>Session::get('customerId')])->first();
    $update_data->title                =     $request->title;
    $update_data->slug                 =     strtolower(preg_replace('/\s+/u', '-', trim($request->title)));
    $update_data->category_id          =     $request->category;
    $update_data->subcategory_id       =     $request->subcategory;
    $update_data->division_id          =     $request->division_id;
    $update_data->dist_id              =     $request->dist_id;
    $update_data->thana_id             =     $request->thana_id;
    $update_data->union_id             =     $request->union_id;
    $update_data->phone                =     $request->phone;
    $update_data->email                =     $request->email;
    $update_data->phone                =     $request->phone;
    $update_data->version              =    $request->version;
    $update_data->brand                =     $request->brand;
    $update_data->model                =     $request->model;
    $update_data->edition              =     $request->edition;
    $update_data->feature              =     $request->feature;
    $update_data->type                 =    $request->type;
    $update_data->price                =     $request->price;
    $update_data->full_address         =     $request->full_address;
    $update_data->request              =     0;
    $update_data->ads_id               =     $ads_id;
    $update_data->description          =     $request->description;
    $update_data->customer_id          =     $request->customer;
    $update_data->save();
        
        $ads_id=$update_data->id;
        $update_images=Adsimage::where('id',$request->hidden_img)->get();
        $images = $request->file('image');
        if($images){
            foreach($images as $image){
                
               
                 $name =  time().'-'.$image->getClientOriginalName();
                 $uploadpath = 'public/uploads/advertisment/';
                 $imageUrl = $uploadpath.$name; 
                 $img=Image::make($image->getRealPath());
                 $img->orientate();
                 $width = 695; // your max width
                 $height = 325; // your max height
                 $img->height() > $img->width() ? $width=null : $height=null;
                 $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // paste another image
                // $watermark = 'public/frontEnd/images/watermark.png';
                // $img->insert($watermark,'bottom-right', 20, 20);
                $img->save($imageUrl); 

                $newimage= new Adsimage();
                $newimage->ads_id = $ads_id;
                $newimage->image=$imageUrl;
                $newimage->save(); 
             }
                
        }else{
            foreach($update_images as $update_image){
                $update_image->image    =   $update_image->image;
                $update_image->save();
            }
        }
       
     Toastr::success('message', 'Advertisment update successfully!');
     return redirect('customer/0/control-panel/manage-my-ads');
    }
    public function adsimagedel($id){
        $delete_img = Adsimage::find($id);
        $delete_img->delete();
        Toastr::success('message', 'advertisments image  delete successfully!');
        return redirect()->back();
    }
    public function adsPremium(Request $request){
        $find_ads = Advertisment::where(['id'=>$request->hidden_id,'customer_id'=>Session::get('customerId')])->first();
        $find_ads->premium = 2;
        $find_ads->save();
        Toastr::success('message', 'advertisments image  delete successfully!');
        return redirect()->back();
    }
    public function deleteads($slug,$id){
        $delete_img = Advertisment::where(['id'=>$request->hidden_id,'customer_id'=>Session::get('customerId')])->first();
        $delete_img->delete();
        $delete_img=$delete_img->id;
        $delete_images = Adsimage::where('ads_id',$delete_img)->get();
        foreach($delete_images as $delete_image){
                $delete_id=$delete_image->id;
                $delete_img=Adsimage::where('id',$delete_id);
                $delete_img->delete();
            }
        Toastr::success('message', 'advertisments  delete successfully!');
        return redirect()->back();
    }
}
