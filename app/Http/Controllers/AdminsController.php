<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class AdminsController extends Controller
{
//    public function __construct()
//    {
//         $this->middleware("check.login", [
//            "except" => [],
//        ]);
//
//    }

    //管理员页
    public function index()
    {
        $admins = Admins::Paginate(5);
        return view("admins/index", compact("admins"));
    }

    //增加数据
    public function create()
    {
        $roles = Role::all();
        return view("admins/create",compact("roles"));
    }

    //添加保存
    public function store(Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:20",
            "password" => "required|min:6",
            "repassword" => "required|min:6",
            "email" => "required",

        ], [
            "name.required" => "用户名不能为空！",
            "password.min" => "密码必须大于6个字符！",
            "password.required" => "密码不能为空！",
            "repassword.min" => "确认密码必须大于6个字符！",
            "repassword.required" => "确认密码不能为空！",
            "email.required" => "邮箱不能为空！",
        ]);
        if ($request->password != $request->repassword) {
            session()->flash("danger", "两次输入的密码不一致！");
            return redirect()->route("admins.create");

        }
            $data=['name' => $request->name,
                'password' => bcrypt($request->password),
                'email' =>$request->email,
            ];

        $admin = Admins::create($data);

        $admin->assignRole($request->role);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("admins.index");
    }

    //修改回显
    public function edit(Admins $admin)
    {
        $roles = Role::all();
        return view("admins/edit", compact("admin","roles"));
    }

    //修改保存
    public function update(Admins $admin, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:20",
            "password" => "required|min:6",
            "repassword" => "required|min:6",
            "email" => "required",

        ], [
            "name.required" => "用户名不能为空！",
            "password.min" => "密码必须大于6个字符！",
            "password.required" => "密码不能为空！",
            "repassword.min" => "确认密码必须大于6个字符！",
            "repassword.required" => "确认密码不能为空！",
            "email.required" => "邮箱不能为空！",
        ]);
        if ($request->password != $request->repassword) {
            session()->flash("danger", "两次输入的密码不一致！");
            return redirect()->route("admins.create");

        }
        $data=['name' => $request->name,
            'password' => bcrypt($request->password),
            'email' =>$request->email,
        ];
        $admin->update($data);
        $roles = Role::all();
        foreach ($roles as $role){
            $admin->removeRole($role->name);
        }
        $admin->assignRole($request->role);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("admins.index");
    }

    //删除
    public function destroy(Admins $admin)
    {
        $roles = Role::all();
        foreach ($roles as $role){
            $admin->removeRole($role->name);
        }
        $admin->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("admins.index");
    }
}
