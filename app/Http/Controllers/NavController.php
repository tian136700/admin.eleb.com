<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //菜单列表页
    public function index()
    {
        $navs = Nav::Paginate(5);
        return view("nav/index", compact("navs"));
    }

//导航显示栏
    public function nav()
    {
        $navs = Nav::all();
        return view("nav/index", compact("navs"));
    }

    //添加菜单页
    public function create()
    {
        $navs = Nav::all();
        $permissions = Permission::all();
        return view("nav/create", compact("permissions", "navs"));
    }

    //添加保存
    public function store(Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",
            "url" => "required",

        ], [
            "name.required" => "菜单名称不能为空！",
            "name.max" => "菜单名称不能超过50个字！",
            "url.required" => "路由不能为空！",
        ]);

        $data = ['name' => $request->name,
            'url' => $request->url,
            'pid' => $request->pid,
            'url' => $request->url,
            'permission_id' => $request->permission_id,

        ];
        Nav::create($data);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("navs.index");

    }

    //修改回显
    public function edit(Nav $nav)
    {
        $navs = Nav::all();
        $permissions = Permission::all();
        return view("nav/edit", compact("nav", "navs", "permissions"));
    }

    //修改保存
    public function update(Nav $nav, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",
            "url" => "required",

        ], [
            "name.required" => "菜单名称不能为空！",
            "name.max" => "菜单名称不能超过50个字！",
            "url.required" => "路由不能为空！",
        ]);

        $data = ['name' => $request->name,
            'url' => $request->url,
            'pid' => $request->pid,
            'url' => $request->url,
            'permission_id' => $request->permission_id,

        ];
        $nav->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("navs.index");
    }

    //删除
    public function destroy(Nav $nav)
    {
        $nav->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("navs.index");
    }
}
