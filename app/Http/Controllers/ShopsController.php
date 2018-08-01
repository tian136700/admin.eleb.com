<?php

namespace App\Http\Controllers;

use App\Models\ShopCategories;
use App\Models\Shops;
use App\Models\ShopUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    //主页
    public function index()
    {

        $shops = Shops::Paginate(5);

        return view("shops/index", compact("shops"));
    }

//增加数据
    public function create()
    {
        $categories = ShopCategories::all();

        return view("shops/create", compact("categories"));
    }

//添加保存
    public function store(Request $request)
    {
//        //获取上传的文件
        $file = $request->shop_img;
        //数据表单验证
        $this->validate($request, [
            "shop_name" => "required|max:50",
            "name" => "required|max:50",
            "password" => "required",
            "start_send" => "required",
            "repassword" => "required",
            "email" => "required",
            'captcha' => 'required|captcha',
        ], [
            "shop_name.required" => "店铺名称不能为空！",
            "shop_name.max" => "店铺名称不能超过50个字！",
            "name.required" => "用户名不能为空！",
            "password.required" => "密码不能为空！",
            "repassword.required" => "确认密码不能为空！",
            "start_send.required" => "起送金额未填写！",
            "email.required" => "邮箱未填写！",
            "send_cost.required" => "配送费未填写！",
            "name.max" => "用户名不能超过50个字！",
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if ($request->password != $request->repassword) {
            session()->flash("danger", "两次输入的密码不一致！");
            return redirect()->route("shops.create");

        }
        if (empty($file)) {
            session()->flash("danger", "必须上传店铺图片！");
            return redirect()->route("shops.create");
        }

        //评分
        $sore = $request->shop_rating??"";
        $data = ['shop_name' => $request->shop_name,
            'shop_category_id' => $request->shop_category_id,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'shop_rating' => $sore,
            'status' => 1,
            'shop_img' => $file,
        ];


        //开启事物
        DB::beginTransaction();
        try {
            Shops::create($data);
            //获取插入的商户id
            $id = DB::getPdo()->lastInsertId();
            $userdata = ["name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "status" => $request->status,
                "shop_id" => $id,
            ];
            ShopUsers::create($userdata);
            //提交事物
            DB::commit();
            //跳转提示信息
            session()->flash("success", "添加成功！");
            return redirect()->route("shops.index");

        } catch (QueryException $ex) {
            session()->flash('success', '添加失败');
            DB::rollback(); //回滚事务

            return redirect()->route('shops.create');
        }


    }

//查看页面
    public function show(Shops $shop)
    {
        $categories = ShopCategories::all();
        return view("shops/show", compact("shop", "categories"));
    }

//修改回显
    public function edit(Shops $shop)
    {
        $categories = ShopCategories::all();
        return view("shops/edit", compact("shop", "categories"));
    }

//修改保存
    public function update(Shops $shop, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "shop_name" => "required|max:50",
            "name" => "required|max:50",
            "start_send" => "required",
            "email" => "required",

        ], [
            "shop_name.required" => "店铺名称不能为空！",
            "shop_name.max" => "店铺名称不能超过50个字！",
            "name.required" => "用户名不能为空！",


            "start_send.required" => "起送金额未填写！",
            "email.required" => "邮箱未填写！",
            "send_cost.required" => "配送费未填写！",
            "name.max" => "用户名不能超过50个字！",

        ]);


        //评分
        $sore = $request->shop_rating??"";

        $data = ['shop_name' => $request->shop_name,
            'shop_category_id' => $request->shop_category_id,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'shop_rating' => $sore,
            'status' => $request->status,
        ];
        $file = $request->shop_img;
        if ($file) {

            $data = ['shop_name' => $request->shop_name,
                'shop_category_id' => $request->shop_category_id,
                'brand' => $request->brand,
                'on_time' => $request->on_time,
                'fengniao' => $request->fengniao,
                'bao' => $request->bao,
                'piao' => $request->piao,
                'zhun' => $request->zhun,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'shop_rating' => $sore,
                'status' => 1,
                'shop_img' => $file,
            ];
        }

        $shop->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("shops.show", [$shop]);
    }

//删除
    public function destroy(Shops $shop)
    {
        $shop->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("shops.index");
    }

//商家审核页面
    public function review(Shops $review)
    {
        $categories = ShopCategories::all();
        return view("shops/review", compact("review", "categories"));
    }

    //审核状态更新
    public function updateReview(Shops $review, Request $request)
    {
        $data = ['status' => $request->status,];
        $review->update($data);
        //跳转提示信息
        session()->flash("success", "状态更新成功！");
        return redirect()->route("shops.show", [$review]);
    }
    //重置密码功能页面
    public function reset(Shops $shop)
    {
        return view("shops/reset",compact("shop"));
    }

    //重置密码提交
    public function updateReset(Shops $shop, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "password" => "required",
            "repassword" => "required",
        ], [

            "password.required" => "密码不能为空！",
            "repassword.required" => "确认密码不能为空！",

        ]);
        if ($request->password != $request->repassword) {
            session()->flash("danger", "两次输入的密码不一致！");
            return redirect()->route("shops.create");

        }
        $data = ['password' => bcrypt($request->password),];
        $shop->update($data);
        //跳转提示信息
        session()->flash("success", "密码更新成功！");
        return redirect()->route("shops.show", [$shop]);
    }
}
