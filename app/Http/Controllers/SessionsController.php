<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //
    public function create()
    {
//        if(Auth::check()){
//            //用户已登陆
//            return redirect("/shops");
//        }
        return view("sessions/create");
    }

    public function store(Request $request)
    {

        //对用户名密码进行认证
        if (Auth::attempt([
            "name" => $request->name,
            "password" => $request->password
        ],$request->remember)
        ) {
            return redirect("/shops")->with("success", "登陆成功！");
        } else {
            return back()->with("danger", "用户名或密码错误！")->withInput();
        }
    }

    public function test()
    {
        Users::create([
            "name" => "admin",
            "password" => bcrypt("123456"),
        ]);
        return "添加成功";
    }

    //注销
    public function destroy()
    {
//        dd(1111);
        Auth::logout();

        return redirect()->route("slogin")->with("success", "注销成功");
    }

}
