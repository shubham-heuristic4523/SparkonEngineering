<?php

namespace App\Http\Controllers;

use App\Models\ItemCategoryModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //return view('Country_Master_List');

            //$Countrys = ItemCategoryModel::all();

            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '6')
                ->first();

            $ItemCats = ItemCategoryModel::join('usermaster', 'usermaster.userId', '=', 'item_category_master.user_id')
               ->join('item_category_type_master', 'item_category_type_master.item_cat_type_id','=','item_category_master.item_cat_type_id')
                ->where('item_category_master.delflag', '=', '0')
                ->get(['item_category_master.*', 'usermaster.username','item_category_type_master.item_cat_type_name']);
 


            // $Countrys = Country::where('delflag','=', '0')->get();   

            return view('ItemCategoryList', compact('ItemCats', 'CheckForm'));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try {
               $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
            return view('ItemCategoryMaster', compact('ItemCategoryType'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'item_cat_name' => 'required',
            ]);

            $input = $request->all();

            ItemCategoryModel::create($input);

            return redirect()->route('ItemCategory.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

        // Country.index  Country is Url name  and index is above method

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategoryModel  $ItemCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function show($item_cat_id)
    {
        try {
            $ItemCats = ItemCategoryModel::find($item_cat_id);
            $isView = "1";
            return view('Country_Master', compact('ItemCats', 'ItemCats', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemCategoryModel  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($item_cat_id)
    {
        //
        try {

            $ItemCats = ItemCategoryModel::find($item_cat_id);
            $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();

            return view('ItemCategoryMaster', compact('ItemCats', 'ItemCategoryType'));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemCategoryModel  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $ItemCats = ItemCategoryModel::findOrFail($id);

            $this->validate($request, [
                'item_cat_name' => 'required',
            ]);

            $input = $request->all();

            $ItemCats->fill($input)->save();

            return redirect()->route('ItemCategory.index')->with('message', 'Update Record Succesfully');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategoryModel  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($item_cat_id)
    {
        try {
            ItemCategoryModel::where('item_cat_id', $item_cat_id)
                ->update(['delflag' => 1]);

            Session::flash('delete', 'Deleted record successfully');
            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    
    public function getItemCatByType(Request $request)
    {
          //DB::enableQueryLog();
          $ItemCat=DB::table('item_category_master')->select("item_category_master.*")
          ->where('delflag','=',0)
          ->where('item_cat_type_id','=',$request->item_cat_type_id)
          ->get();
      // dd(DB::getQueryLog());
    
        $html = "<option>--Select--</option>";
    
        foreach($ItemCat as $ItemCatRow)
        {
        $html .= "<option value='".$ItemCatRow->item_cat_id."'> $ItemCatRow->item_cat_name</option>";
        }
        return response()->json(['html' => $html]);
     }


}
