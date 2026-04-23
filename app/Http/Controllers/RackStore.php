<?php

namespace App\Http\Controllers;
use App\Models\RackStoreModel;
use Illuminate\Http\Request;

class RackStore extends Controller
{
    //
    public function create(){
        return view('rack_store');
    }

    public function store(Request $request){
        RackStoreModel::create([
            'rack_no' => $request->rack_no,
             'deflag'=> 0,
            'crated_at' => now()
        ]);
        return redirect()->route('rack.index')->with('success','Data Added Successfully');
    }

    public function edit($rack_id)
    {
        $RackData = RackStoreModel::where('rack_id', $rack_id)->first();
        return view('rack_store', compact('RackData'));
    }

    public function update(Request $request, $rack_id)
    {
        $data = RackStoreModel::find($rack_id);

        $data->update([
            'rack_no' => $request->rack_no
        ]);

        return redirect()->route('rack.index')
                        ->with('success', 'Updated Successfully');
    }

     public function index(){
        $RackData = RackStoreModel::where('deflag', 0)->get();
        return view('rack_list', compact('RackData'));
    }

     public function destroy($rack_id)
    {
        RackStoreModel::where('rack_id', $rack_id)->update([
            'deflag' => 1
        ]);

        return redirect()->route('rack.index')
                        ->with('success','Deleted Successfully');
    }

        
}
