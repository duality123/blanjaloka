<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::when(request()->search, function ($permissions) {
            $permissions = $permissions->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        return inertia('Pages/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'permission'   => 'required',
        ]);

        Permission::create(['name' => $request->permission, 'guard_name' => 'web']);

        return redirect()->route('permission.index');
    }


    public function edit(Permission $permission)
    {
        return inertia('Pages/Permission/Edit', [
            'permission' => $permission,
        ]);
    }


    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'permission'   => 'required',
        ]);

        $permission->update(['name' => $request->permission]);

        return redirect()->route('permission.index');
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permission.index');
    }
}
