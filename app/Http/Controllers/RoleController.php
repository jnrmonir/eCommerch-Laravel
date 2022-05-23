<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function RoleManager(){
         // $role = Role::create(['name' => 'Admin']);
      // return  $permission = Permission::create(['name' => 'Category List']);
        return view('backend.role.role',[
            'permission'=>Permission::all(),
            'roles'=>Role::all(),
            'users'=>User::all(),
        ]);
    }

    function RoleAddToPermission(Request $request){
       $role_name=$request->role_name;
       $permission_name=$request->permission_name;
       $role=Role::where('name', $role_name)->first();
      //  $role->givePermissionTo($permission_name); //assign multiple permission 
       $role->syncPermissions($permission_name);  // assign replace permission and add new permission
       return back();
    }

    function UserAddToRole(Request $request){
        $user_name=$request->user_name;
        $role_name=$request->role_name;
        $user=User::where('name', $user_name)->first();
      //   $user->assignRole($role_name); //assign multiple roles 
        $user->syncRoles($role_name); //assign multiple roles and update 

      //   $user=User::findOrFail($request->user_id);
      //   $user->syncRoles($request->role_name);
        return back();
     }

     function EditUserPermission($user_id){
        return view('backend.role.role_edit',[
           'users'=>User::findOrFail($user_id),
           'permissions'=>Permission::all(),
        ]);
     }

     function PermissionEditPost(Request $request){
         $user=User::findOrFail($request->user_id);
         $user->givePermissionTo($request->permission);
         return back();
     }
}
