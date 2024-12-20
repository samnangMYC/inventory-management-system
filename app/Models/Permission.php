<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    static public function getSingle($id){
        return Role::find($id);
    }

    static public function getRecord()
{
       // Fetch all permissions
       $permissions = Permission::all();

       // Initialize an array to hold the grouped permissions
       $groupedPermissions = [];
   
       // Loop through each permission
       foreach ($permissions as $permission) {
           // Check if the group already exists
           if (!isset($groupedPermissions[$permission->groupBy])) {
               // If not, create a new group
               $groupedPermissions[$permission->groupBy] = [
                   'name' => $permission->name, // Main category name
                   'group' => [] // Initialize sub-permissions array
               ];
           }
   
           // Add the current permission to the sub-permissions array
           if ($permission->id != $permission->groupBy) { // Avoid adding the main category itself
               $groupedPermissions[$permission->groupBy]['group'][] = [
                   'id' => $permission->id,
                   'name' => $permission->name
               ];
           }
       }
   
       // Convert the associative array to a numerically indexed array
       return array_values($groupedPermissions);
}


}
?>