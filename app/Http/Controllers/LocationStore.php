<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationStoreModel;
class LocationStore extends Controller
{
    //

    public function create(){
        return view('location_store');
    }

    public function index(){
        $LocationData = LocationStoreModel::where('deflag', 0)->get();
        return view('location_store_list', compact('LocationData'));
    }

    public function store(Request $request){
        LocationStoreModel::create([
            'location' => $request->location,
            'deflag'=> 0,
            'crated_at' => now()
        ]);
        return redirect()->route('location.index')->with('success','Data Added Successfully');
    }

    public function destroy($location_id)
    {
        LocationStoreModel::where('location_id', $location_id)->update([
            'deflag' => 1
        ]);

        return redirect()->route('location.index')
                        ->with('success','Deleted Successfully');
    }

    public function edit($location_id)
    {
        $LocationData = LocationStoreModel::where('location_id', $location_id)->first();
        return view('location_store', compact('LocationData'));
    }

    public function update(Request $request, $location_id)
    {
        $data = LocationStoreModel::find($location_id);

        $data->update([
            'location' => $request->location
        ]);

        return redirect()->route('location.index')
                        ->with('success', 'Updated Successfully');
    }

}
