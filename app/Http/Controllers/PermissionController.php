<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //权限列表
    public function index()
    {

        $permissions = Permission::Paginate(5);

        return view("permission/index", compact("permissions"));
    }

    //增加权限
    public function create()
    {

        return view("permission/create");
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


        Permission::create($data);

        session()->flash("success", "添加成功！");
        return redirect()->route("permissions.index");


    }

    //修改回显
    public function edit(Permission $permission)
    {
        return view("permission/edit", compact("permission"));
    }

    //修改保存
    public function update(Permission $permission, Request $request)
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
        $permission->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("permissions.index", [$permission]);
    }
    //删除
    public function destroy(Permission $permission)
    {
        $permission->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("permissions.index");
    }
}
