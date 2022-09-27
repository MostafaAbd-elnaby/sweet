<?php

namespace App\Http\Controllers;

use App\Models\staffs;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Controller
{
    /*
     * Start Roles [ Show - Add - Edit - Delete - Assign Permission to roll ]
     */

    public function showRolls () {
        return response()->json(Role::with('permissions')->get());
    }

    public function updateOrInsertRole (Request $req) {

        $role_name = Role::where('name', $req->name)->first();

        if ($role_name) {
            return response()->json(['error' => true]);
        }

        if ($req->id){
            $role = Role::find($req->id);
        }else {
            $role = new Role();
        }

        $role->guard_name = 'staffs';
        $role->name = $req->name;
        $role->save();

        return response()->json($role);
    }

    public function deleteRole (Request $req) {
        $role = Role::whereIn('id', $req->id);
        $role->delete();
        return response()->json($role);
    }

    /*
     * End Roles [ Add - Edit - Delete  ]
     * -----------------------------------------------
     * Start Permission [ Show - Add - Edit - Delete  ]
     */

    public function showPermission () {
        return response()->json(Permission::get());
    }

    public function updateOrInsertPermission (Request $req) {

        $role_name = Permission::where('name', $req->name)->first();

        if ($role_name) {
            return response()->json(['error' => true]);
        }

        if ($req->id){
            $role = Permission::find($req->id);
        }else {
            $role = new Permission();
        }

        $role->guard_name = 'staffs';
        $role->name = $req->name;
        $role->save();

        return response()->json($role);
    }

    public function deletePermission (Request $req) {
        $permission = Permission::whereIn('id',$req->id);
        $permission->delete();
        return response()->json($permission);
    }

    /*
     * End Permission [ Add - Edit - Delete  ]
     *-----------------------------------------------
     *  Assign Permission to roll
     */

    public function assignPermissionToRoll (Request $req) {

        $role = Role::find($req->role_id);

       $permission = Permission::whereIn('id', $req->permissions_id)->get();

        $role->syncPermissions($permission);

        return response()->json($role);
    }

    /*
     *  revoke Permission to roll
     */
    public function revokePermissionToRoll (Request $req) {

        $role = Role::find($req->role_id);

        $permission = Permission::whereIn('id', $req->permissions_id)->get('id');

        $role->revokePermissionTo($permission);

        return response()->json($role);
    }

    /*
     * Give Roll To Stuff
     */

    public function giveRollStaff (Request $req) {

        $role = Role::whereIn('id', $req->role_id)->get();

        $stuff = staffs::find($req->staff_id);

        $stuff->syncRoles($role);

//        $stuff['getPermissionsViaRoles'] = $stuff->getPermissionsViaRoles();

        return response()->json($stuff);
    }

    /*
     * Revoke Roll From Stuff
     */

    public function revokeRollStaff (Request $req) {

        $role = collect(Role::whereIn('id', $req->role_id)->get());

        $role = $role->pluck('name');

        $stuff = staffs::find($req->staff_id);

        $stuff->syncRoles($role);

        return response()->json($stuff);
    }

}
