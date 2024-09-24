<?php

namespace App\Http\Controllers;

use App\Models\CallBy;
use App\Models\InstallBy;
use Illuminate\Http\Request;

class InstallByController extends Controller
{
    public function index(){
        $installBy = InstallBy::all();
        $callBy = CallBy::all();
        // dd($installBy, $callBy);
        return view('admin.content.installByTable', compact('installBy', 'callBy'));
    }
    // public function create(Request $request){

    //     $request->validate([
    //         'install_by' =>'required|string|max:255'
    //     ]);
    //     InstallBy::create([
    //         'install_by' => $request->install_by,
    //     ]);
    //     return back()->with('success', 'Install By added successfully');
    // }
    // public function edit($id){
    //     $installBy = InstallBy::find($id);
    //     // return view('admin.content.editInstallBy', compact('installBy'));
    // }
    // public function update(Request $request){
    //     // dd($request);
    //    $request->validate([
    //         'install_by' =>'required|string|max:255'
    //     ]);
    //     // dd($data);
    //     $installBy = InstallBy::find($request->id);
    //     // dd($installBy);
    //     $installBy->update([
    //         'install_by' => $request->install_by,  // Assuming 'id' is the primary key in the 'install_by' table. Adjust as needed.  // 'update_install_by' is the field name in your 'install_by' table. Adjust as needed.  // 'install_by' is the value to be updated in the 'install_by' table. Adjust as needed.  // 'id' is the id of the record to be updated. Adjust as needed.  // 'update' is the method to update the record. Adjust as needed.  // 'install_by' is the name of the field to be updated in the 'install_by' table. Adjust as needed.  // $request->input('install_by') is the value to be updated in the 'install_by' table. Adjust as needed.  // 'install_by' is the name of the field to be updated
    //     ]);
    //     return back()->with('success', 'Install By updated successfully');
    // }
    // public function delete($id){
    //     $installBy = InstallBy::find($id);
    //     $installBy->delete();
    //     return back()->with('success', 'Install By deleted successfully');
    // }
}
