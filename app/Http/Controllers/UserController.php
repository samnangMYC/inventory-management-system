<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['roles'] = Role::all();
   
        // dd(session()->all());
        return view("users", $data); // Pass categories to the view
    }
    public function create()
    {
        return view("users.create");
   
    }

      
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:6|confirmed', // Ensure you have a password confirmation field
        //     'name' => 'required|string|max:255',
        //     'role_id' => 'required|integer|in:1,2',
        // ]);
                // Check if validation fails
        // if ($request->fails()) {
        //     return redirect()->back()
        //             ->withErrors($request)
        //             ->withInput();
        // }        
        // Create a new user
     
        User::create([
            'name' => $request->name, // Include the name field
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role_id' => $request->role_id
        ]);

        return redirect('users')->with('success','User created successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {  
    
          
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    
    }


}