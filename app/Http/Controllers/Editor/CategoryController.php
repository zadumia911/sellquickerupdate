<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Category;

class CategoryController extends Controller
{
    public function create(){
    	return view('backEnd.category.create');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
            'image'=>'required',
    		'status'=>'required',
    	]);
        // image upload
        $file = $request->file('image');
        $name = time().'-'.$file->getClientOriginalName();
        $uploadPath = 'public/uploads/category/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

    	$store_data           	  = 	new Category();
        $store_data->name         =     $request->name;
    	$store_data->slug      	  = 	preg_replace('/\s+/u', '-', trim($request->name));
    	$store_data->text  	      = 	$request->text;
        $store_data->image        =     $fileUrl;
    	$store_data->status  	  = 	$request->status;
    	$store_data->save();
    	Toastr::success('message', 'Category add successfully!');
    	return redirect('editor/category/manage');
    }
    public function manage(){
    	$show_data = Category::orderBy('id','DESC')->get();
    	return view('backEnd.category.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data =   Category::find($id);
        return view('backEnd.category.edit',compact('edit_data'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);
    	$update_data =  Category::find($request->hidden_id);

        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            $name =time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/category/';
           
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }
		$update_data->name     		 = 	$request->name;
        $update_data->slug           =  preg_replace('/\s+/u', '-', trim($request->name));
        $update_data->image          =  $fileUrl;
    	$update_data->status  	  	 = 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Category Update successfully!');
        return redirect('editor/category/manage');
    }
    public function inactive(Request $request){
        $inactive_data           =   Category::find($request->hidden_id);
        $inactive_data->status   =   0;
        $inactive_data->save();
        Toastr::success('message', 'Category inactive successfully!');
        return redirect('editor/category/manage');   
    }
    public function active(Request $request){
        $active_data         =   Category::find($request->hidden_id);
        $active_data->status =   1;
        $active_data->save();
        Toastr::success('message', 'Category active successfully!');
        return redirect('editor/category/manage');   
    }
}
