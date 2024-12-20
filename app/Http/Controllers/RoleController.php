<?php

namespace App\Http\Controllers;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;
class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('role', compact('roles'));
    }
      /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getPermission = Permission::getRecord();
   
        $data['getPermission'] = $getPermission;
        // dd($getPermission);
        return view("role.create" , data: $data);
    }

      
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permission_id' => 'required|array', // Ensure permission_id is an array
            'permission_id.*' => 'exists:permissions,id', // Validate each permission ID
        ]);


        //  Role::create(attributes: $request->all());
        $role = new Role;
        $role->name = $request->name;
        $role->save();
         
         PermissionRole::insertUpdateRecords($request->permission_id,$role->id );
         return redirect('role')->with('success','Role successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {  
         // Use Eloquent's find method to get the role by ID
        $data['getRecord'] = Role::findOrFail($id); // This will throw a 404 if not found
        $getPermission = Permission::getRecord(); // Assuming this method exists
        $data['getPermission'] = $getPermission;
        $data['getRolePermission'] = PermissionRole::getRolePermission($id);

        return view('role.edit', $data);
          
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role =  Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        PermissionRole::insertUpdateRecords($request->permission_id,$role->id );
        return redirect('role')->with('success','Role successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    // Find the role by ID or fail with a 404 error
    $role = Role::findOrFail($id);
    PermissionRole::where('role_id', $role->id)->delete();

    // Delete the role
    $role->delete();

    // Redirect back to the roles index with a success message
    return redirect()->route('role.index')->with('success', 'Role successfully deleted');
    
    }
}
