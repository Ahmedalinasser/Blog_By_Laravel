<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    

    public function index (){

        return view('admin.roles.permissions.index', [

            'permissions'=> Permission::all(),
        ]);
    }


    public function update(Permission $permission){
 
        request()->validate([
            'name'=>['required'],
        ]);
        $permission->name = Str::ucFirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('_');
        if ($permission->isDirty('name')) {
            session()->flash('permission-updated', ' Permission Updated To Be '.  request('name'));
            $permission->save();
        }else{
            session()->flash('permission-updated', 'Nothing is added');   
        }
        return back();
    }


    public function store (){

        request()->validate([
            'name'=>['required'],
        ]);
        Permission::create([
            'name'=>Str::ucFirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('_'),

        ]);
       return back();
    }

    
    public function edit(Permission $permission){

        return  view('admin.roles.permissions.edit',[
            'permission'=> $permission,
            'roles'=> Role::all(),

        ]);

    }



    public function destroy (Permission $permission){

        $permission->delete();
        session()->flash('permission-deleted', 'Delete Role (' . $permission->name . ')');
        return back();

    }

}
