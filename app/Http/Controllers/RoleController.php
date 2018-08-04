<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    //角色列表
    public function index()
    {

        $roles = Role::Paginate(5);

        return view("role/index", compact("roles"));
    }

    //增加角色
    public function create()
    {
        $permissions = Permission::all();
        return view("role/create", compact("permissions"));
    }

    //添加保存
    public function store(Request $request)
    {

        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",

        ], [
            "name.required" => "名称不能为空！",
            "name.max" => "名称不能超过50个字！",
        ]);


        $data = ['name' => $request->name,
        ];

        $role = Role::create($data);
        if (!empty($request->permission)){
            $role->givePermissionTo($request->permission);
        }
        session()->flash("success", "添加成功！");
        return redirect()->route("roles.index");


    }

    //修改回显
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view("role/edit", compact("role", "permissions"));
    }

    //修改保存
    public function update(Role $role, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",

        ], [
            "name.required" => "名称不能为空！",
            "name.max" => "名称不能超过50个字！",
        ]);


        $data = ['name' => $request->name,
        ];
        $role->update($data);

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            //先移除权限
            $permission->removeRole($role);
        }

        if (!empty($request->permission)){
            $role->givePermissionTo($request->permission);
        }

        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("roles.index", [$role]);
    }

    //删除
    public function destroy(Role $role)
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role->revokePermissionTo($permission);

        }
        $role->delete();

        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("roles.index");
    }

}
