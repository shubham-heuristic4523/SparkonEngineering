<?php

namespace App\Http\Controllers;

use App\Models\TabModel;
use App\Models\EmployeeGroupModel;
use App\Models\EmployeeModel;
use App\Models\Country;
use App\Models\State;
use App\Models\DistrictModel;
use App\Models\Taluka;
use App\Models\CityModel;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;
class TabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '1')
->first();




        $TabList = TabModel::join('usermaster', 'usermaster.userId', '=', 'tab_master.created_by')
        ->where('tab_master.delflag','=', '0')
        ->get(['tab_master.*','usermaster.username']);



       // $Countrys = Country::where('delflag','=', '0')->get();   

        return view('TabMaster', compact('TabList','CheckForm'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp_groupmasterList = EmployeeGroupModel::where('delflag', '0')->get();
        $emp_masterList = EmployeeModel::where('delflag', '0')->get();
        $Country_List = Country::where('delflag', '0')->get();
        $State_List = State::where('delflag', '0')->get();
        $District_List = DistrictModel::where('delflag', '0')->get();
        $Taluka_List = Taluka::where('delflag', '0')->get();
        $City_List = CityModel::where('delflag', '0')->get();

        return view('TabMaster', compact('emp_groupmasterList', 'emp_masterList','Country_List','State_List','District_List','Taluka_List','City_List'));
    }
    
    public function getEmployeesByGroup($egroup_id)
    {
        $employees = EmployeeModel::where('egroup_id', $egroup_id)->where('delflag', '0')->get();
        return response()->json($employees);
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->where('delflag', '0')->get();
        return response()->json($states);
    }

    public function getDistricts($state_id)
    {
        $districts = DistrictModel::where('state_id', $state_id)->where('delflag', '0')->get();
        return response()->json($districts);
    }

    public function getTalukas($dist_id)
    {
        $talukas = Taluka::where('dist_id', $dist_id)->where('delflag', '0')->get();
        return response()->json($talukas);
    }

    public function getCities($taluka_id)
    {
        $cities = CityModel::where('taluka_id', $taluka_id)->where('delflag', '0')->get();
        return response()->json($cities);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         Log::info('Received request data', $request->all());
    
    //         // Validate the incoming request
    //         $this->validate($request, [
    //             // Add other necessary fields validation here
    //         ]);
    
    //         // Get the user ID from session and prepare input
    //         $input = $request->all();
    //         $input['created_by'] = Session::get('userId'); // Get the user ID from session
    
    //         // Handle file upload if file is present
    //         if ($request->hasFile('uploadfile')) {
    //             $fileName1 = time().'PO.'.$request->uploadfile->extension();  
    //             $request->uploadfile->move(public_path('uploads'), $fileName1);
    //             $fullTempFilePath = public_path('uploads/');
    //             $output = shell_exec("shrink " . $fullTempFilePath . $fileName1 . "-compressed ");
    //             shell_exec("mv " . $fullTempFilePath . $fileName1 . "-compressed " . $fullTempFilePath);
    //             $fullTempFilePath = $fileName1;
    //         } else {
    //             $fileName1 = ''; // No file selected, set the variable to an empty string
    //         }
    
    //         // Add fileName1 to input data, whether it's an empty string or the actual file name
    //         $input['uploadfile'] = $fileName1;
    
    //         // Create the record in the TabModel
    //         TabModel::create($input);
    
    //         // Commit the transaction
    //         DB::commit();
    
    //         Log::info('Status - Record saved successfully');
            
    //         // Redirect with success message
    //         return redirect()->route('Tab.create')->with('message', 'Record saved successfully.');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('Status - Record not saved successfully', ['error' => $e->getMessage()]);
    
    //         // Redirect with failure message
    //         return redirect()->route('Tab.index')->with('message', 'Record not saved. Please try again later.');
    //     }
    // }
    
//     public function store(Request $request)
// {
//     DB::beginTransaction();
//     try {
//         Log::info('Received request data', $request->all());

//         // Validate the incoming request (add validation as needed)
//         $this->validate($request, [
//             // Add other necessary fields validation here
//         ]);

//         // Get the user ID from session and prepare input
//         $input = $request->all();
//         $input['created_by'] = Session::get('userId'); // Get the user ID from session

//         // Handle file upload if file is present
//         if ($request->hasFile('uploadfile')) {
//             $fileName1 = time().'PO.'.$request->uploadfile->extension();  
//             $request->uploadfile->move(public_path('uploads'), $fileName1);
//             $fullTempFilePath = public_path('uploads/');
//             $output = shell_exec("shrink " . $fullTempFilePath . $fileName1 . "-compressed ");
//             shell_exec("mv " . $fullTempFilePath . $fileName1 . "-compressed " . $fullTempFilePath);
//             $fullTempFilePath = $fileName1;
//         } else {
//             $fileName1 = ''; // No file selected, set the variable to an empty string
//         }

//         // Add fileName1 to input data, whether it's an empty string or the actual file name
//         $input['uploadfile'] = $fileName1;

//         // Create the record in the TabModel
//         TabModel::create($input);

//         // Commit the transaction
//         DB::commit();

//         Log::info('Status - Record saved successfully');
        
//         if (isset($input['pipe_id'])) {
//             if ($input['pipe_id'] == 1) {
//                 return redirect()->route('Leads.view', ['enquiry_id' => $input['ldq_id']])
//                     ->with('message', 'Record saved successfully.');
//             } elseif ($input['pipe_id'] == 2) {
//                 return redirect()->route('Deals.view', ['deal_id' => $input['ldq_id']])
//                     ->with('message', 'Record saved successfully.');
//             } elseif ($input['pipe_id'] == 3) {
//                 return redirect()->route('quotes.view', ['quote_id' => $input['ldq_id']])
//                 ->with('message', 'Record saved successfully.');
//             } elseif ($input['pipe_id'] == 4) {
//                 return redirect()->route('people.show', ['people_id' => $input['ldq_id']])
//                 ->with('message', 'Record saved successfully.');
//             }
//             elseif ($input['pipe_id'] == 5) {
//                 return redirect()->route('Customer.show', ['customer_id' => $input['ldq_id']])
//                 ->with('message', 'Record saved successfully.');
//             }
//         }else {
//             return redirect()->route('Tab.create')->with('message', 'Record saved successfully.');
//         }
//     } catch (Exception $e) {
//         DB::rollBack();
//         Log::error('Status - Record not saved successfully', ['error' => $e->getMessage()]);

//         // Redirect with failure message
//         return redirect()->route('Tab.index')->with('message', 'Record not saved. Please try again later.');
//     }
// }
public function store(Request $request)
{
    DB::beginTransaction();
    try {
        Log::info('Received request data', $request->all());

        // Validate the incoming request (add validation as needed)
        $this->validate($request, [
            // Add other necessary fields validation here
        ]);

        // Get the user ID from session and prepare input
        $input = $request->all();
        $input['created_by'] = Session::get('userId'); // Get the user ID from session

        // Handle file upload if file is present
        if ($request->hasFile('uploadfile')) {
            // Get the original file name
            $originalFileName = $request->uploadfile->getClientOriginalName();  
            
            // Create a unique file name (timestamp + file extension)
            $fileName1 = time().'_PO.'.$request->uploadfile->extension();  

            // Move the uploaded file to the public directory
            $request->uploadfile->move(public_path('uploads'), $fileName1);

            // Optional: Perform additional operations like compression
            $fullTempFilePath = public_path('uploads/');
            $output = shell_exec("shrink " . $fullTempFilePath . $fileName1 . "-compressed ");
            shell_exec("mv " . $fullTempFilePath . $fileName1 . "-compressed " . $fullTempFilePath);
            $fullTempFilePath = $fileName1;

            // Add both the original file name and processed file name to the input
            $input['uploadfile'] = $fileName1; // Processed file name for storage
            $input['original_filename'] = $originalFileName; // Store the original file name
        } else {
            $input['uploadfile'] = '';  // No file selected, set to empty string
            $input['original_filename'] = ''; // No file selected, set original name to empty
        }

        // Create the record in the TabModel
        TabModel::create($input);

        // Commit the transaction
        DB::commit();

        Log::info('Status - Record saved successfully');
        
        // Handle redirection based on pipe_id
        if (isset($input['pipe_id'])) {
            if ($input['pipe_id'] == 1) {
                return redirect()->route('EnquiryPunching.view', ['enquiry_id' => $input['ldq_id']])
                    ->with('message', 'Record saved successfully.');
            } elseif ($input['pipe_id'] == 2) {
                return redirect()->route('Deals.view', ['deal_id' => $input['ldq_id']])
                    ->with('message', 'Record saved successfully.');
            } elseif ($input['pipe_id'] == 3) {
                return redirect()->route('quotes.view', ['quote_id' => $input['ldq_id']])
                    ->with('message', 'Record saved successfully.');
            } elseif ($input['pipe_id'] == 4) {
                return redirect()->route('people.show', ['people_id' => $input['ldq_id']])
                    ->with('message', 'Record saved successfully.');
            } elseif ($input['pipe_id'] == 5) {
                return redirect()->route('Customer.show', ['customer_id' => $input['ldq_id']])
                    ->with('message', 'Record saved successfully.');
            }
        } else {
            return redirect()->route('Tab.create')->with('message', 'Record saved successfully.');
        }
    } catch (Exception $e) {
        DB::rollBack();
        Log::error('Status - Record not saved successfully', ['error' => $e->getMessage()]);

        // Redirect with failure message
        return redirect()->route('Tab.index')->with('message', 'Record not saved. Please try again later.');
    }
}


public function getUploadedFiles($quoteId)
{
    $files = TabModel::where('ldq_id', $quoteId)
                ->whereNotNull('uploadfile')
                ->pluck('uploadfile')
                ->toArray();

    return response()->json(['files' => $files]);
}
// public function getUploadedleadFiles($leadId)
// {
//     $files = TabModel::where('ldq_id', $leadId)
//                 ->whereNotNull('uploadfile')
//                 ->pluck('uploadfile')
//                 ->toArray();

//     return response()->json(['files' => $files]);
// }
public function getUploadedleadFiles($leadId)
{
    $files = TabModel::where('ldq_id', $leadId)
                ->whereNotNull('uploadfile')
                ->get(); // Fetch full records instead of just filenames

    return response()->json(['files' => $files]);
}

public function getUploadeddealFiles($dealId)
{
    $files = TabModel::where('ldq_id', $dealId)
                ->whereNotNull('uploadfile')
                ->pluck('uploadfile')
                ->toArray();

    return response()->json(['files' => $files]);
}
public function getUploadedpeopleFiles($peopleId)
{
    $files = TabModel::where('ldq_id', $peopleId)
                ->whereNotNull('uploadfile')
                ->pluck('uploadfile')
                ->toArray();

    return response()->json(['files' => $files]);
}
public function getUploadedcustomerFiles($customerId)
{
    $files = TabModel::where('ldq_id', $customerId)
                ->whereNotNull('uploadfile')
                ->pluck('uploadfile')
                ->toArray();

    return response()->json(['files' => $files]);
}


}