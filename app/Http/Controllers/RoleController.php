<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index (){

        return view('admin.roles.authorizations.index', [
            'roles'=> Role::all(),

        ]);
    }



    public function store (){

        request()->validate([
            'name'=>['required'],
        ]);
        Role::create([
            'name'=>Str::ucFirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('_'),

        ]);
       return back();
    }


        public function update(Role $role){
 
            request()->validate([
                'name'=>['required'],
            ]);
            $role->name = Str::ucFirst(request('name'));
            $role->slug = Str::of(Str::lower(request('name')))->slug('_');
            if ($role->isDirty('name')) {
                session()->flash('role-updated', 'Role Updated To Be '.  request('name'));
                $role->save();
            }else{
                session()->flash('role-updated', 'Nothing is added');   
            }
            return back();
        }
 
    public function edit(Role $role){

        return  view('admin.roles.authorizations.edit',[
            'role'=> $role,
            'permissions'=> Permission::all(),

        ]);

    }

    public function attach_permission (Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }


    public function detach_permission (Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy (Role $role){

        $role->delete();
        session()->flash('role-deleted', 'Delete Role (' . $role->name . ')');
        return back();

    }


    
}
