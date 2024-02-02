<?php

namespace App\Http\Controllers\Controller_ui;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    function list(Request $request)
    {
        if ($request->keyword) {
            $roles = Role::where('name', 'like', '%' . $request->keyword . '%')->paginate(10);
        } else {
            $roles = Role::paginate(10);
        }
        return view('admin.role.list', compact('roles'));
    }
    function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.add', compact('permissions'));
    }
    function store(RoleCreateRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->attach($request->input('permission_id'));
        return redirect('/admin/role/list')->with('status', 'Đã thêm vai trò thành công');
    }

    function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.edit', compact('role', 'permissions'));
    }
    function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->input('permission_id', []));
        return redirect('/admin/role/list')
            ->with('status', 'Đã Cập nhật vai trò thành công');
    }
    function copy($role)
    {
        $role = Role::findOrFail($role);
        $data = Role::create([
            'name' => $role->name,
            'description' => $role->description,
        ]);
        return redirect('/admin/role/list')

            ->with('status', 'Đã thêm vai trò thành công');
    }
    function delete(Role $role)
    {
        $role->delete();
        return redirect('/admin/role/list')
            ->with('status', 'Đã xóa vai trò thành công');
    }


}
