<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\CallRecord;
use App\Models\SliderImage;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;


class IndexController extends Controller
{
    public function index(Request $request){
        $currentYear = $request->input('year', Carbon::now()->year);

        $statuses = [
            1 => 'Follow Up',
            2 => 'Lead',
            3 => 'Prospects',
            4 => 'Non-Prospects',
            5 => 'Already Renewed',
            6 => 'Dealer Details',
            7 => 'Purchased New',
            8 => 'Switched to Another AV',
            9 => 'Not Connected'
        ];
        $id = Auth::user()->id;
    
        $statusCounts = CallRecord::select('call_status', DB::raw('count(*) as count'))
            ->groupBy('call_status')
            ->pluck('count', 'call_status')
            ->toArray();

            foreach ($statuses as $id => $name) {
                if (!isset($statusCounts[$id])) {
                    $statusCounts[$id] = 0;
                }
            }
            $chartData = [
                'labels' => array_values($statuses),
                'data' => array_values($statusCounts),
            ];
            if (Auth::user()->role !== 'admin') {
                $monthlyCalls = CallRecord::with('calledBy')
                ->whereHas('calledBy', function($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    DB::raw('DATE_FORMAT(created_tymeold, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereYear('created_tymeold', $currentYear) // Filter by year
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get()
                ->pluck('count', 'month')
                ->toArray();
            }else {
                $monthlyCalls = CallRecord::select(
                    DB::raw('DATE_FORMAT(created_tymeold, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereYear('created_tymeold', $currentYear) // Filter by year
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get()
                ->pluck('count', 'month')
                ->toArray();
            }
            // Generate labels and data for the bar chart
            $months = [];
            $calls = [];
            foreach ($monthlyCalls as $month => $count) {
                $months[] = date("F Y", strtotime($month)); // Format to "Month Year"
                $calls[] = $count;
            }
            $barChartData =[
                'months' => $months, 
                'calls' => $calls
            ];
            // Define the range for the data to fetch
        
        $totalProducts = Product::count();
         if (Auth::user()->role == 'admin') {
            $totalSell = Registration::sum('amount');
            $customer = Registration::count();
         }else{
            $totalSell = Registration::where('call_by', Auth::user()->id)->sum('amount');
            $customer = Registration::where('call_by', Auth::user()->id)->count();
         }
        $totalQuantity = Product::sum('qty');

        // Get the requested year or default to the current year
        $year2 = $request->input('year2', date('Y'));
    
        // Fetch sales data grouped by month for the specified year
        if (Auth::user()->role !== 'admin') {
        $salesData = Registration::with('calledBy')
        ->whereHas('calledBy', function($query) use ($id) {
            $query->where('user_id', $id);
        })->select(DB::raw('SUM(amount) as total_sales'), DB::raw('MONTH(created_date) as month'))
            ->whereYear('created_date', $year2)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        }else {
            $salesData = Registration::select(DB::raw('SUM(amount) as total_sales'), DB::raw('MONTH(created_date) as month'))
            ->whereYear('created_date', $year2)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        }
    
        // Prepare data for the chart
        $months = [];
        $sales = [];
    
        // Initialize all months with 0 sales
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F'); // Get month name
            $sales[$i] = 0; // Set initial sales value to 0
        }
    
        // Fill the sales data
        foreach ($salesData as $data) {
            $sales[$data->month] = $data->total_sales;
        }
    
        // Re-index $sales to sync with the months array
        $sales = array_values($sales);
         $sellChart = [
            'months' => $months,
            'sales' => $sales,
            'year' => $year2,
         ];
    
       return view('admin.content.dashbord', compact('totalProducts','totalQuantity', 'customer', 'chartData','barChartData','currentYear','totalSell','sellChart'));
    }

    public function showSalesChart(Request $request)
    {
        // Get the requested year or default to the current year
        $year = $request->input('year', date('Y'));
    
        // Fetch sales data grouped by month for the specified year
        $salesData = Registration::select(DB::raw('SUM(amount) as total_sales'), DB::raw('MONTH(created_date) as month'))
            ->whereYear('created_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Prepare data for the chart
        $months = [];
        $sales = [];
    
        // Initialize all months with 0 sales
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F'); // Get month name
            $sales[$i] = 0; // Set initial sales value to 0
        }
    
        // Fill the sales data
        foreach ($salesData as $data) {
            $sales[$data->month] = $data->total_sales;
        }
    
        // Re-index $sales to sync with the months array
        $sales = array_values($sales);
         $sellChart = [
            'months' => $months,
            'sales' => $sales,
            'year' => $year,
         ];
        // Pass data to the view, including the current year
        return view('welcome', compact('months', 'sales', 'year', 'sellChart'));
    }
    
    public function addEmployee(){
        // if(Gate::allows('isAdmin')){
            return view('admin.content.employeeRegister');
        // }
    }

    public function upload(Request $request)
    {
        // Validate the image file type and size
        $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('slider_image')) {
            $fileName = time() . '.' . $request->file('slider_image')->extension();
            $path = $request->file('slider_image')->storeAs('uploads/slider_images', $fileName, 'public');
            SliderImage::create([
                'image' => $path
            ]);
            return back()->with('success', 'Image uploaded successfully!');
        }
        return back()->with('error', 'Image upload failed!');
     
    }
    public function showSliderImage(){
        $images = SliderImage::all();
        return view('admin.content.sliderImages', compact('images'));
    }

    public function delete($id)
    {
        // Find the image by id
        $imageCount = SliderImage::all();
        if($imageCount->count() <= 3){
            return back()->with('error', 'You must have at least 3 images in the slider.');
        }

        $image = SliderImage::find($id);
        
        // Delete the image file from storage
        $imagePath = public_path('uploads/slider_images/' . $image->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the image record from the database
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}
