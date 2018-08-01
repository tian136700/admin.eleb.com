<?php

namespace App\Http\Controllers;

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
//        dd($request->permission);

        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",
//            "guard_name" => "required",

        ], [
            "name.required" => "名称不能为空！",
            "name.max" => "名称不能超过50个字！",
//            "guard_name.required" => "描述不能为空！",
        ]);


        $data = ['name' => $request->name,
//            'guard_name' => $request->guard_name,
        ];


        $role = Role::create($data);
        $role->givePermissionTo($request->permission);
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
            "guard_name" => "required",

        ], [
            "name.required" => "名称不能为空！",
            "name.max" => "名称不能超过50个字！",
            "guard_name.required" => "描述不能为空！",
        ]);


        $data = ['name' => $request->name,
            'guard_name' => $request->guard_name,
        ];
        $role->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("roles.index", [$role]);
    }

    //删除
    public function destroy(Role $role)
    {
        $role->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("roles.index");
    }
}
