<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\District;
use App\Thana;
use DB;
class ThanaController extends Controller
{
    
    public function create(){
    	return view('backEnd.thana.create');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'thana_name'=>'required',
            'dist_id'=>'required',
    		'status'=>'required',
    	]);

    	$store_data                    = new Thana();
    	$store_data->thana_name   = $request->thana_name;
        $store_data->slug              =   preg_replace('/\s+/u', '-', trim($request->thana_name));
    	$store_data->district_id       = $request->dist_id;
    	$store_data->status            = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'Thana add successfully!');
    	return redirect('/editor/thana/manage');
    }
    public function manage(){
        $show_data = DB::table('districts')
            ->join('thanas', 'districts.id', '=', 'thanas.district_id')
            ->select('thanas.*', 'districts.dist_name')
            ->orderBy('id','DESC')
            ->get();
    	return view('backEnd.thana.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = Thana::find($id);
        return view('backEnd.thana.edit', compact('edit_data'));
    }
      public function update(Request $request){
        $update_data                 =   Thana::find($request->hidden_id);
        $update_data->thana_name    =    $request->thana_name;
        $update_data->slug           =   preg_replace('/\s+/u', '-', trim($request->thana_name));
        $update_data->district_id        =    $request->dist_id;
        $update_data->status         =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Thana Update successfully!');
        return redirect('editor/thana/manage');
    }

    public function inactive(Request $request){
        $inactive = Thana::find($request->hidden_id);
        $inactive->status=0;
        $inactive->save();
        Toastr::success('message', 'Thana active successfully!');
        return redirect('/editor/thana/manage');
    }

    public function active(Request $request){
        $active = Thana::find($request->hidden_id);
        $active->status=1;
        $active->save();
        Toastr::success('message', 'Thana active successfully!');
        return redirect('/editor/thana/manage');
    }
}
