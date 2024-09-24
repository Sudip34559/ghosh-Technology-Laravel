<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CallBy;
use App\Models\Product;
use App\Models\CompCode;
use App\Models\InstallBy;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\PaymentRecvBy;
use App\Exports\RegistrationsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function index(Request $request)
{
    $column = $request->query('column', 'id'); // Default sort column to 'id'
    $order = $request->query('order', 'asc');  // Default sort order
    $search = $request->query('search', '');   // Default search query to empty

    // Validate column and order
    $validColumns = [
        'id', 
        'product',
        'installation_date',
        'customer_name', 
        'expiry_date'
    ];
    
    if (!in_array($column, $validColumns)) {
        $column = 'id';
    }
    if (!in_array($order, ['asc', 'desc'])) {
        $order = 'asc';
    }
   
    $query = Registration::with(['products', 'calledBy']);
    //  dd($query);
    // Apply search filter if provided
    if (!empty($search)) {
        $query->where(function ($query) use ($search) {
            $query->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('installation_date', 'like', "%{$search}%")
                  ->orWhere('expiry_date', 'like', "%{$search}%")
                  ->orWhere('mobile_no', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");

                  $query->orWhereHas('products', function ($query) use ($search) {
                       $query->where('prod_list', 'like', "%{$search}%");
                   });
        });

    }

    $registrations = $query->orderBy($column, $order)->paginate(20);

    if ($request->ajax()) {
        return response()->json([
            'data' => $registrations->items(),
            'pagination' => (string) $registrations->links()->render(),
        ]);
    }
    //  dd($registrations);
    return view('admin.content.registrationTable', compact('registrations', 'column', 'order'));
}

    public function registrationForm()
{

        $product = Product::where('qty', '>', 0)->get();
        $installBy = InstallBy::all();
        $callBy = CallBy::all();
        $compCode = CompCode::all();
        $payRcvBy = PaymentRecvBy::all();

        return view('admin.content.registration', compact('product', 'installBy', 'callBy', 'compCode', 'payRcvBy'));
    
}
function create(Request $request)
{

        // validate the data
        // dd($request->all());
        $request->validate([
            'product_id' =>'required',
            'ins_by' =>'required',
            'call_by' =>'required',
            'com_code' =>'required',
            'pay_recv_by' =>'required',
            'customer_name' =>'required|max:25|min:2',
        //    'mobile_no' =>'required',
        //    'address' =>'required',
            'amount' =>'required',
            'installation_date'=>'required|date',
            'expiry_date'=>'required|date',
            // 'product_key_1'=>'required',
            // 'batch_no'=>'required'
        ],[
            'product_id.required' => 'Product is required',
            'ins_by.required' => 'Installer is required',
            'call_by.required' => 'Caller is required',
            'comp_code.required' => 'Company Code is required',
            'pay_recv_by.required' => 'Payment Received By is required',
            'customer_name.required' => 'Customer Name is required',
        //    'mobile_no.required' => 'Mobile No is required',
            // 'address.required' => 'Address is required',
            'amount.required' => 'Amount is required',
            'installation_date.required' => 'Installation Date is required',
            'expiry_date.required' => 'Expiry Date is required',
            // 'com_code.required' => 'Company Code is required',
            // 'product_key_1.required' => 'Product Key 1 is required',
        ]);
        $product = Product::where('id', $request->product_id)->first();
        // dd($product->qty);
        if ($product->qty === 0){
            return back()->with('error', 'This product is not available');
        }
        // dd($request->all());
        $red = Registration::create([
            'product' => $request->product_id,
            'installation_date' => $request->installation_date,
            'expiry_date' => $request->expiry_date,
           'renewal_key' => $request->renewal_key ?? '',
            'ins_by' => $request->ins_by,
            'call_by' => $request->call_by,
            'com_code' => $request->com_code,
            'payment_received_by' => $request->pay_recv_by,
            'customer_name' => $request->customer_name,
            'email_id' => $request->email_id ??'',
           'mobile_no' => $request->mobile_no ??'',
            'address' => $request->address ??'',
            'amount' => $request->amount,
            'product_key_1' => $request->product_key_1 ??'',
            'product_key_2' => $request->product_key_2 ?? '',
            'product_key_3' => $request->product_key_3 ?? '',
            'product_key_4' => $request->product_key_4 ?? '',
            'product_key_5' => $request->product_key_5 ?? '',
            'product_key_6' => $request->product_key_6 ?? '',
            'product_key_7' => $request->product_key_7 ?? '',
            'product_key_8' => $request->product_key_8 ?? '',
            'product_key_9' => $request->product_key_9 ?? '',
            'product_key_10' => $request->product_key_10 ?? '',
            'batch_no' => $request->batch_no ?? '',
        ]);
        if (!$red) {
            return back()->with('error', 'Failed to create registration');
        } 
      
       $product->qty = $product->qty - 1;
       $product->save();
        // redirect to the registration list
        return back()->with('success', 'Registration created successfully');
}
public function show($id)
{
    // Fetch the registration with relationships
    $registration = Registration::with(['products', 'installedBy', 'calledBy', 'paymentReceivedBy'])
                                ->findOrFail($id);
        // dd($registration->payment_received_by);
        $payment = PaymentRecvBy::find($registration->payment_received_by);
        // dd( $payment);
    // Return the view with the registration data

   
    return view('admin.content.registrationDetail', compact('registration', 'payment'));
    
}

    public function edit($id){
        // Fetch the registration with relationships
        $registration = Registration::with(['products', 'installedBy', 'calledBy', 'paymentReceivedBy'])
                                ->findOrFail($id);
        $product = Product::all();
        $installBy = InstallBy::all();
        $callBy = CallBy::all();
        $compCode = CompCode::all();
        $payRcvBy = PaymentRecvBy::all();
        // dd($registration);
        // Return the view with the registration data
        $validEditor = $registration->calledBy !== null ?( $registration->calledBy->user_id === Auth::user()->id ? true : false) : false;
        if(Auth::user()->role === 'admin' || $validEditor){
            return view('admin.content.editRegistration', compact('registration', 'product', 'installBy', 'callBy', 'compCode', 'payRcvBy'));
        }
        return back()->with('error', 'Unauthorized Access');
       
    }
    public function update(Request $request, $id){
        // validate the data
        $request->validate([
            'product_id' =>'required',
            'ins_by' =>'required',
            'call_by' =>'required',
            'com_code' =>'required',
            'pay_recv_by' =>'required',
            'customer_name' =>'required|max:25|min:2',
        //    'mobile_no' =>'required',
        //    'address' =>'required',
            'amount' =>'required',
            'installation_date'=>'required|date',
            'expiry_date'=>'required|date',
            // 'com_code' =>'required',
            // 'product_key_1'=>'required',
            // 'batch_no'=>'required'
        ],[
            'product_id.required' => 'Product is required',
            'ins_by.required' => 'Installer is required',
            'call_by.required' => 'Caller is required',
            'com_code.required' => 'Company Code is required',
            'pay_recv_by.required' => 'Payment Received By is required',
            'customer_name.required' => 'Customer Name is required',
        ]);
        // dd($request->all());
        $registration = Registration::with(['calledBy'])
                                ->findOrFail($id);
        $validEditor = $registration->calledBy !== null ?( $registration->calledBy->user_id === Auth::user()->id ? true : false) : false;
        if(Auth::user()->role === 'admin' || $validEditor){
            $red = Registration::find($id)->update([
                'product' => $request->product_id,
                'installation_date' => $request->installation_date,
                'expiry_date' => $request->expiry_date,
               'renewal_key' => $request->renewal_key ?? '',
                'ins_by' => $request->ins_by,
                'call_by' => $request->call_by,
                'com_code' => $request->com_code,
                'payment_received_by' => $request->pay_recv_by,
                'customer_name' => $request->customer_name,
                'email_id' => $request->email_id ??'',
               'mobile_no' => $request->mobile_no ??'',
                'address' => $request->address ??'',
                'amount' => $request->amount,
                'product_key_1' => $request->product_key_1 ??'',
                'product_key_2' => $request->product_key_2 ?? '',
                'product_key_3' => $request->product_key_3 ?? '',
                'product_key_4' => $request->product_key_4 ?? '',
                'product_key_5' => $request->product_key_5 ?? '',
                'product_key_6' => $request->product_key_6 ?? '',
                'product_key_7' => $request->product_key_7 ?? '',
                'product_key_8' => $request->product_key_8 ?? '',
                'product_key_9' => $request->product_key_9 ?? '',
                'product_key_10' => $request->product_key_10 ?? '',
                'batch_no' => $request->batch_no ?? '',
               
            ]);

            if (!$red) {
                return back()->with('error', 'Failed to update registration');
            }
            // redirect to the registration list
        return redirect()->route('registrations.index')->with('success', 'Registration updated successfully');
        }
        return back()->with('error', 'Unauthorized Access');   
    }
    public function exportCsv()
    {
        return Excel::download(new RegistrationsExport, 'registrations.csv');
    }

    public function monthlyData(Request $request)
    {
        // Validate if the 'month_year' input is provided
        if ($request->filled('month_year')) {
            // Validate the input month and year format (YYYY-MM)
            $request->validate([
                'month_year' => 'required|date_format:Y-m',  // Validate that input is in 'YYYY-MM' format
            ]);
    
            // Extract the year and month from the input
            $monthYear = $request->input('month_year');
            $year = Carbon::parse($monthYear)->year;
            $month = Carbon::parse($monthYear)->month;
    
            // Base query for retrieving registrations for the specific year and month
            $query = Registration::with(['products'])
                ->whereYear('created_date', $year)
                ->whereMonth('created_date', $month);
    
            // Get the paginated results
            $registrations = $query->paginate(10);
    
            // Get total count for the base query
            $count = Registration::with(['products'])
            ->whereYear('created_date', $year)
            ->whereMonth('created_date', $month)->count();
    
            // Clone the query and get count for 'call_done' (Yes/No)
            $callDoneCount = Registration::whereYear('created_date', $year)
                ->whereMonth('created_date', $month)
                ->whereIn('call_done', ['Yes', 'No'])
                ->count();
    
            // Clone the query and get count for 'review' (Yes/No)
            $reviewCount = Registration::whereYear('created_date', $year)
                ->whereMonth('created_date', $month)
                ->whereIn('review', ['Yes', 'No'])
                ->count();
    
            // Return the view with the filtered data
            return view('admin.content.getMonthlyData', compact('registrations', 'count', 'month', 'year', 'callDoneCount', 'reviewCount'));
        }
    
        // If no 'month_year' is provided, return a default view
        return view('admin.content.getMonthlyData');
    }
    


    public function updateStatus(Request $request){
        // dd($request->all());
        Registration::find($request->id)->update([
          'call_done' => $request->call_done ?? 'Not Connected',
          'call_comment' => $request->call_comment ?? null,
          'review' => $request->review ?? 'Not Connected',
          'review_comment' => $request->review_comment ?? null
        ]);
        $query = $request->only(['month_year', 'page']);
        return redirect()->route('registration.monthly',  $query)->with('success', 'Status updated successfully');
    }
}
