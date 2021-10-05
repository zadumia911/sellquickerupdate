<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Division;
class DivisionController extends Controller
{
    
    public function create(){
    	return view('backEnd.division.create');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		'status'=>'required',
    	]);

    	$store_data           	  = 	new Division();
        $store_data->name         =     $request->name;
    	$store_data->slug      	  = 	preg_replace('/\s+/u', '-', trim($request->name));
    	$store_data->status  	  = 	$request->status;
    	$store_data->save();
    	Toastr::success('message', 'Division add successfully!');
    	return redirect('editor/division/manage');
    }
    public function manage(){
    	$show_data = Division::orderBy('id','DESC')->get();
    	return view('backEnd.division.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data =   Division::find($id);
        return view('backEnd.division.edit',compact('edit_data'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);

    	$update_data = Division::find($request->hidden_id);
		$update_data->name     		 = 	$request->name;
        $update_data->slug           =  preg_replace('/\s+/u', '-', trim($request->name));
    	$update_data->status  	  	 = 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Division Update successfully!');
        return redirect('editor/division/manage');
    }
    public function inactive(Request $request){
        $inactive_data           =   Division::find($request->hidden_id);
        $inactive_data->status   =   0;
        $inactive_data->save();
        Toastr::success('message', 'Division inactive successfully!');
        return redirect('editor/division/manage');   
    }
    public function active(Request $request){
        $active_data         =   Division::find($request->hidden_id);
        $active_data->status =   1;
        $active_data->save();
        Toastr::success('message', 'Division active successfully!');
        return redirect('editor/division/manage');   
    }
}
