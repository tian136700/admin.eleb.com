<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //显示会员列表页
    public function index(Request $request)
    {
        $where = [];
        //判断是否搜索名称
        $keyword = [];
        if ($request->username) {
            $where[] = ['username', 'like', "%{$request->username}%"];
            $keyword['username'] = $request->username;
        }
        $members = Member::where($where)->Paginate(5);
        return view("member/index", compact("members","keyword"));
    }

    public function disable(Member $member,Request $request)
    {
        //禁用
        if ($request->status==1){
            $member->update(["status"=>0]);
            session()->flash("danger", "账号禁用成功！");
            return back();
        }
        if ($request->status==0){
            $member->update(["status"=>1]);
            session()->flash("success", "账号启用成功！");
            return back();
        }

    }

    public function show(Member $member)
    {
        return view("member/show", compact("member"));
    }



}
