<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypeMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '27')
                ->first();

            $DocumentType = DocumentTypeMasterModel::where('document_type_master.delflag', '=', '0')
                ->get(['document_type_master.*']);


            return view('DocumentTypeMasterList', compact('DocumentType', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('DocumentTypeMaster');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'document_type_name' => 'required',
            ]);

            $input = $request->all();

            DocumentTypeMasterModel::create($input);

            return redirect()->route('DocumentType.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($document_type_id)
    {
        try {
            $dip = DocumentTypeMasterModel::find($document_type_id);
            $isView = "1";
            return view('DocumentTypeMaster', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($document_type_id)
    {

        try {

            $DocumentType = DocumentTypeMasterModel::find($document_type_id);

            return view('DocumentTypeMaster', compact('DocumentType', 'DocumentType'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //
            $dip = DocumentTypeMasterModel::findOrFail($id);

            $this->validate($request, [
                'document_type_name' => 'required',
            ]);

            $input = $request->all();

            $dip->fill($input)->save();

            return redirect()->route('DocumentType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($document_type_id)
    {
        try {
            DocumentTypeMasterModel::where('document_type_id', $document_type_id)
                ->update([
                    'delflag' => 1,
                    'updated_by' => Session::get('userId')
                ]);

            Session::flash('delete', 'Deleted record successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
