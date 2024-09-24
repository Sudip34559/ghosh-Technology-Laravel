<?php

namespace App\Http\Controllers;

use App\Models\CallBy;
use App\Rules\FutureDate;
use App\Models\CallRecord;
use App\Models\CaseStatus;
use App\Models\Registration;
use Illuminate\Http\Request;

class CallRecordeController extends Controller
{
    public function getCallRecordsByDateRange(Request $request)
    {
        // Fetch all case statuses to display in the form regardless of input
        $caseStatus = CaseStatus::all();
    
        // Check if the necessary input is present
        if ($request->filled('installation_date') && $request->filled('expiry_date') ) {
            // Validate the request input
            $request->validate([
                'installation_date' => 'required|date',
                'expiry_date' => 'required|date|after_or_equal:installation_date',
            ]);
    
            // Retrieve the dates and case_id from the request
            $installationDate = $request->input('installation_date');
            $expiryDate = $request->input('expiry_date');
            $case_id = $request->input('case_id');
            // dd($case_id);
            if ($case_id === 'null') {
                $registrations = Registration::with('callRecords','callRecords.caseStatus','products')->where('expiry_date', '<=', $expiryDate)
                ->where('expiry_date', '>=', $installationDate)
                ->paginate(10);
                // dd('null');
            }else{
                $registrations = Registration::with('callRecords', 'callRecords.caseStatus', 'products')
                ->where('expiry_date', '<=', $expiryDate)
                ->where('expiry_date', '>=', $installationDate)
                ->whereHas('callRecords', function($query) use ($case_id) {
                    $query->where('call_status', $case_id);
                })
                ->paginate(10);
                // dd('pp');
            
            }
            $callBy = CallBy::all();
            $callStatus = CaseStatus::all();

            // Return the view with paginated data
            return view('admin.content.getCallRecored', compact('registrations', 'caseStatus','callBy','callStatus','installationDate', 'expiryDate'));
        }
    
        // If the request is empty, just show the form without data
        return view('admin.content.getCallRecored', compact('caseStatus'));
    }
    public function getCallBooks($id){
        // dd($id);
        $callRecordes = CallRecord::where('cust_id', $id)->with('calledBy', 'caseStatus')->get();
        // dd($callRecordes->count());

        return response()->json($callRecordes);

    }

    public function addCallStatus(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'cust_id' => 'required',
            'call_note' =>'required',
            'call_by' =>'required',
            'call_status' =>'required',
        ]);
        $callRecord = CallRecord::create([
            'cust_id' => $request->cust_id,
            'call_note' => $request->call_note,
            'call_by' => $request->call_by,
            'call_status' => $request->call_status,
            'created_tyme' => date('y-m-d'),
            'call_time'=>$request->call_time
        ]);

        $query = $request->only(['_token','installation_date', 'expiry_date', 'case_id']);
        // dd($query);
    return redirect()->route('callRecords.index', $query)->with('success', 'Call status updated successfully.');
    }
    
}
