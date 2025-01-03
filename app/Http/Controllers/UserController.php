<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRole;
use App\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('User', Auth::user()->role_id);
        $data['PermissionAdd'] = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit User', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRole::getPermission('Delete User', Auth::user()->role_id);
        $data['PermissionRoles'] = PermissionRole::all();
        if(!$PermissionRole){
            abort(404);
        }
        $data['users'] = User::all();
        $data['roles'] =  Role::all();
      
        // dd(session()->all());
        return view("users", $data); // Pass categories to the view
    }
    public function create()
    {
        $data['roles'] = Role::all();
        return view("users.create",$data);
   
    }
      
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Ensure you have a password confirmation field
            'name' => 'required|string|max:255',
        ]);
                // Check if validation fails
        // if ($request->fails()) {
        //     return redirect()->back()
        //             ->withErrors($request)
        //             ->withInput();
        // }        
        // Create a new user
        // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id; // Ensure this is set
        $user->save();
    

        return redirect('users')->with('success','User created successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {  
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['roles'] = Role::all();
        return view('users.edit',data: $data);
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:0,1', 
            'role_id' => 'required'       
        ]);
        // dd($request->all());
        // Find the user by ID
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id; 
        $user->status = $request->status;

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the new password
        }

        // Save the user
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User  updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        // Delete the user
        $user->delete();
        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    
    }


}