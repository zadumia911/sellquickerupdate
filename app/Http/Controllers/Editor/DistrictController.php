<?php

namespace App\Http\Controllers\Editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Division;
use App\District;
use DB;
class DistrictController extends Controller
{
    
    public function create(){
     	$area = Division::where('status',1)->get();
    	return view('backEnd.district.create',compact('area'));
    }
    public function store(Request $request){
    	$this->validate($request,[
            'dist_name'=>'required',
            'division_id'=>'required',
    		'status'=>'required',
    	]);

    	$store_data                    = new District();
    	$store_data->dist_name   = $request->dist_name;
        $store_data->slug              =   preg_replace('/\s+/u', '-', trim($request->dist_name));
    	$store_data->division_id       = $request->division_id;
    	$store_data->status            = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'District add successfully!');
    	return redirect('/editor/district/manage');
    }
    public function manage(){
        $show_data = DB::table('districts')
            ->join('divisions', 'districts.division_id', '=', 'divisions.id')
            ->select('districts.*', 'divisions.name')
            ->orderBy('id','DESC')
            ->get();
    	return view('backEnd.district.manage',compact('show_data'));
    }
     public function edit($id){
        $area = District::where('status',1)->get();
        $edit_data = District::find($id);
        return view('backEnd.district.edit', compact('edit_data','area'));
    }
      public function update(Request $request){
        $update_data                 =   District::find($request->hidden_id);
        $update_data->dist_name    =    $request->dist_name;
        $update_data->slug           =   preg_replace('/\s+/u', '-', trim($request->dist_name));
        $update_data->division_id        =    $request->division_id;
        $update_data->status         =    $request->status;
        $update_data->save();
        Toastr::success('message', 'District Update successfully!');
        return redirect('editor/district/manage');
    }

    public function inactive(Request $request){
        $inactive = District::find($request->hidden_id);
        $inactive->status=0;
        $inactive->save();
        Toastr::success('message', 'District active successfully!');
        return redirect('/editor/district/manage');
    }

    public function active(Request $request){
        $active = District::find($request->hidden_id);
        $active->status=1;
        $active->save();
        Toastr::success('message', 'District active successfully!');
        return redirect('/editor/district/manage');
    }
}
