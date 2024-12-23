<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'permission_role';

    // Assuming you have these columns in your permission_role table
    protected $fillable = ['permission_id', 'role_id'];

    static function insertUpdateRecords($permission_ids, $role_id)
    {
        PermissionRole::where('role_id', $role_id)->delete();
        foreach ($permission_ids as $permission_id) {
            $data[] = [
                'permission_id' => $permission_id,
                'role_id' => $role_id,
            ];
        }

        // Use insert to add multiple records at once
        self::insert($data);
    }
    static public function getRolePermission($role_id){
        return PermissionRole::where('role_id', $role_id)->get(); // Correct usage
    }
    static public function getPermission($slug,$role_id){
        return PermissionRole::select('permisssion_role.id')
                    ->join('permissions','permissions.id','=','permission_role.permission_id')
                    ->where('role_id','=',$role_id)
                    ->where('permissions.slug','=',$slug)
                    ->count();
    }
}

?>
