<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Exports\ProductsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $column = $request->query('column', 'id'); // Default sort column to 'id'
        $order = $request->query('order', 'asc');  // Default sort order
        $search = $request->query('search', '');   // Default search query to empty
    
        // Validate column and order
        $validColumns = ['id', 'prod_list', 'qty'];
        if (!in_array($column, $validColumns)) {
            $column = 'id';
        }
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }
    
        $query = Product::query();
    
        // Apply search filter if provided
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('prod_list', 'like', "%{$search}%")
                      ->orWhere('qty', 'like', "%{$search}%");
            });
        }
    
        $products = $query->orderBy($column, $order)->paginate(20);
    
        if ($request->ajax()) {
            return response()->json([
                'data' => $products->items(),
                'pagination' => (string) $products->links()->render(), // Ensure pagination links are properly rendered
            ]);
        }
    
        return view('admin.content.productTable', compact('products', 'column', 'order'));
    }
    
    

    public function destroy(Request $request)
    {
        Product::destroy($request->id);
        return back()->with(['success' => 'Product deleted successfully!']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:20',
            'quantity' =>'required|integer',
        ]);
         Product::where('id', $request->id)->update([
            'prod_list' => $request->name,
            'qty' => $request->quantity,
        ]);
        
        return back()->with(['success' => 'Product updated successfully!']);
    }

    
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);

        $data = Excel::import(new ProductImport, $request->file('file'));
        if(!$data){
            return back()->with('error', 'something went wrong');
        }
        return back()->with('success', 'Data Imported Successfully');
    }
public function create(Request $request)
{
    $request->validate([
        'name' =>'required|string',
        'quantity' =>'required|integer',
    ]);
    $product = Product::create([
        'prod_list' => $request->name,
        'qty' => $request->quantity,
    ]);
    if (!$product) {
        return back()->with('error', 'Failed to create product');
    }
    return back()->with(['success' => 'Product created successfully!']);
   
}

public function showCsv()
{
    $filePath = storage_path('app/public/files/example.csv');
//  dd($filePath);
    if (file_exists($filePath)) {
        // dd($filePath);
        $res =  Response::file($filePath, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'inline; filename="sud.csv"'
        ]);
        // dd($res);
        return $res;
    } else {
        return redirect()->back()->with('error', 'File not found.');
    }
}
public function csvExporter(){
    return Excel::download(new ProductsExport, 'products.csv');
}
public function exportPDF()
{
    // Fetch only the 'prod_list' and 'qty' columns from the Product model
    $products = Product::all(['prod_list', 'qty']);
    
    // Load the Blade view with the products data and generate the PDF
    $pdf = Pdf::loadView('admin.components.pdf', compact('products'));

    // Return the generated PDF file for download
    return $pdf->download('admin.components.pdf');
}

}
