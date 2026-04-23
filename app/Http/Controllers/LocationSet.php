<?php

namespace App\Http\Controllers;

use App\Models\LocationSetModel;
use Illuminate\Http\Request;

class LocationSet extends Controller
{

    public function create(){
    return view('location_set');
    }

    public function index(){
        $LocationData = LocationSetModel::where('deflag', 0)->get();
        return view('location_set_list', compact('LocationData'));
    }
    
    //
    public function store(Request $request){
        LocationSetModel::create([
            'location' => $request->location,
            'address' => $request->address,
            'naration' => $request->naration,
            'deflag'=> 0,
            'crated_at' => now()
        ]);
        return redirect()->route('location-set.index')->with('success','Data Added Successfully');
    }

   public function destroy($loc_id)
    {
        LocationSetModel::where('loc_id', $loc_id)->update([
            'deflag' => 1
        ]);

        return redirect()->route('location-set.index')
                        ->with('success','Deleted Successfully');
    }

    public function edit($loc_id)
    {
        $LocationData = LocationSetModel::where('loc_id', $loc_id)->first();
        return view('location_set', compact('LocationData'));
    }

    public function update(Request $request, $loc_id)
    {
        $data = LocationSetModel::find($loc_id);

        $data->update([
            'location' => $request->location,
            'address' => $request->address,
            'naration' => $request->naration
        ]);

        return redirect()->route('location-set.index')
                        ->with('success', 'Updated Successfully');
    }
    
    public function show($loc_id)
    {
        return redirect()->route('location-set.index');
    }
}
