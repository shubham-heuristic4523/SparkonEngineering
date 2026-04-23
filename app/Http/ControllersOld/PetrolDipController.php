<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;

class PetrolDipController extends Controller
{
    public function index()
    {
        try {
            // check user permission
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();

            // fetch petrol dip data directly from table
            $petrol_dip = DB::table('petrol_dip')
                ->select('*')
                ->get();

            // return to blade
            return view('Petrol_Dip_List', compact('petrol_dip', 'CheckForm'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
