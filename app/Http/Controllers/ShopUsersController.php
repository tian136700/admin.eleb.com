<?php

namespace App\Http\Controllers;

use App\Models\ShopUsers;
use Illuminate\Http\Request;

class ShopUsersController extends Controller
{
    //
    //主页
    public function index()
    {

        $shopusers = ShopUsers::Paginate(5);
        return view("shopusers/index", compact("shopusers"));
    }


    //查看页面
    public function show(ShopUsers $shopuser)
    {

        return view("shopusers/show", compact("shopuser"));
    }

    //修改回显
    public function edit(ShopUsers $shopuser)
    {

//        $this->authorize('update', $shopuser);

        return view("shopusers/edit", compact("shopuser"));
    }

    //修改保存
    public function update(ShopUsers $shopuser, Request $request)
    {
//        $this->authorize('update', $shopuser);

        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:20",
            "password" => "required",
            "email" => "required",
        ], [
            "name.required" => "用户名不能为空！",
            "password.required" => "密码不能为空！",

            "email.required" => "邮箱不能为空！",
            "name.max" => "用户名不能超过20个字！"
        ]);

        if($request->password!=$request->repassword){
            session()->flash("danger","两次输入的密码不一致！");
            return redirect()->route("shopusers.edit",$shopuser);

        }

        $data = ["name" => $request->name,
            "password" => bcrypt($request->password),
            'email' => $request->email,
            'status' => $request->status,
        ];
       
        $shopuser->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("shopusers.show", compact("shopuser"));
    }

    //删除
    public function destroy(ShopUsers $shopuser)
    {

        $shopuser->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("shopusers.index");
    }



}
