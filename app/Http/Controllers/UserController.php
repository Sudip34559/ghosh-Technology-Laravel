<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CallBy;
use App\Models\InstallBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){
        // Show the login form
        if (Auth::check()) {
            // dd(Auth::user()->isActive = 1);
               if(Auth::user()->isActive) {
                return redirect()->route('admin.dashbord');
               }
            return redirect()->route('home')->with('info', 'You are not allowed to access this');
        }
        return view('pages.login');
    }
    public function login(Request $request){
        // Validate the form data
        $request->validate([
            'email' =>'required|email',
            'password' => 'required|min:6',
        ]);

         $user = User::where('email','=', $request->email)->first();
         if (!$user){
            return back()->with('error', 'Invalid credentials. Please try again.');
         }
        //    dd($user->isActive);
           if($user->isActive == 0){
        //    dd($user->isActive);
               // If the user is not active, redirect back to the login page with an error message
               return back()->with('info', 'Your account is not active. Please contact support.');
           }

        // Attempt to authenticate the user
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('admin.dashbord');
        } else {
            // If authentication fails, redirect back to the login page with an error message
            return redirect()->back()->with('error', 'Somthing went wrong. Please try again.');
        }
    }
    public function logout(){
        // Log the user out
        Auth::logout();
        // Redirect to the login page
        return redirect()->route('pages.login');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);

        // Store the user (you might want to store it in a users table as well)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role === 'both' ? 'caller&insteller' : $request->role,
        ]);
    
        // Check the selected role and add to the corresponding table
        switch ($request->role) {
            case 'caller':
                CallBy::create([
                    'call_by' => $user->name,
                    'user_id' =>  $user->id
                ]); // Adjust this according to your table structure
                break;

            case 'installer':
                InstallBy::create([
                    'install_by' => $user->name,
                    'user_id' =>  $user->id
                ]); // Adjust this according to your table structure
                break;

            case 'both':
                CallBy::create([
                    'call_by' => $user->name,
                    'user_id' =>  $user->id
                ]);
                InstallBy::create([
                    'install_by' => $user->name,
                    'user_id' =>  $user ->id
                ]);
                break;
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function employesTable(){
    
        // Fetch all users from the database
        $employees = User::where('role', '!=', 'admin')->get();
        // Pass the employees to the view
        return view('admin.content.employeeTable', compact('employees'));
    }
    public function updateEmployeeStatus($id){
        // Fetch the user from the database
        $employee = User::find($id);

        // Update the status of the user
        $employee->isActive = !$employee->isActive;
        $employee->save();
        // Redirect with success message
        return redirect()->back()->with('success', 'Employee status updated successfully!');
    }
    public function deleteEmployee($id){
        // Fetch the user from the database
        $employee = User::find($id);

        // Delete the user
        $employee->delete();
        // Redirect with success message
        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }

    public function updateEmployee(Request $request, $id){
        // Validate the form data
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|unique:users,email,'.$id,
        ]);

        // Fetch the user from the database
        $employee = User::find($id);

        // Update the user
        $employee->name = $request->name;
        $employee->email = $request->email;
        // $employee->role = $request->role === 'both'? 'caller&insteller' : $request->role;
        $employee->save();

               if (InstallBy::where('user_id', $id)->exists()) {
                        InstallBy::where('user_id', $id)->update([
                            'install_by' => $employee->name
                        ]);
                    }

                    if (CallBy::where('user_id', $id)->exists()) {
                        CallBy::where('user_id', $id)->update([
                            'call_by' => $employee->name
                        ]);
                    }

        // Check the selected role and update the corresponding table
        // switch ($request->role) {
        //     case 'caller':
        //         // Delete the InstallBy record if it exists
        //         if (InstallBy::where('user_id', $id)->exists()) {
        //             InstallBy::where('user_id', $id)->delete();
        //         }
        
        //         // Update the CallBy record if it exists, otherwise create a new one
        //         if (CallBy::where('user_id', $id)->exists()) {
        //             CallBy::where('user_id', $id)->update([
        //                 'call_by' => $employee->name,
        //                 'user_id' => $employee->id
        //             ]);
        //         } else {
        //             CallBy::create([
        //                 'call_by' => $employee->name,
        //                 'user_id' => $employee->id
        //             ]);
        //         }
        //         break;
        
        //     case 'installer':
        //         // Delete the CallBy record if it exists
        //         if (CallBy::where('user_id', $id)->exists()) {
        //             CallBy::where('user_id', $id)->delete();
        //         }
        
        //         // Update the InstallBy record if it exists, otherwise create a new one
        //         if (InstallBy::where('user_id', $id)->exists()) {
        //             InstallBy::where('user_id', $id)->update([
        //                 'install_by' => $employee->name,
        //                 'user_id' => $employee->id
        //             ]);
        //         } else {
        //             InstallBy::create([
        //                 'install_by' => $employee->name,
        //                 'user_id' => $employee->id
        //             ]);
        //         }
        //         break;
        
        //     case 'both':
        //         // Delete existing records in both CallBy and InstallBy if they exist
        //         if (CallBy::where('user_id', $id)->exists()) {
        //             CallBy::where('user_id', $id)->delete();
        //         }
        //         if (InstallBy::where('user_id', $id)->exists()) {
        //             InstallBy::where('user_id', $id)->delete();
        //         }
        
        //         // Create new records for both CallBy and InstallBy
        //         CallBy::create([
        //             'call_by' => $employee->name,
        //             'user_id' => $employee->id
        //         ]);
        //         InstallBy::create([
        //             'install_by' => $employee->name,
        //             'user_id' => $employee->id
        //         ]);
        //         break;
        // }
        

        // Redirect with success message
        return back()->with('success', 'Employee updated successfully!');
    }

    public function changePassword(Request $request){
        // Validate the form data
        // dd($request->all());
       $request->validate([
            'password' => 'required|min:6',
        ]);


        // Fetch the user from the database
        $user = Auth::user();

        // Check if the current password matches the user's password
        
            // Update the user's password
            $user->password = bcrypt($request->password);
            $user->save();

            // Redirect with success message
            return back()->with('success', 'Password changed successfully!');
    }
}

