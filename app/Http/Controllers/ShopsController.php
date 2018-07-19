<?php

namespace App\Http\Controllers;

use App\Models\ShopCategories;
use App\Models\Shops;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    //主页
    public function index()
    {

        $shops = Shops::Paginate(5);

        return view("shops/index",compact("shops"));
    }
//增加数据
    public function create()
    {
        $categories= ShopCategories::all();

        return view("shops/create",compact("categories"));
    }
//添加保存
    public function store(Request $request)
    {
//        //获取上传的文件
        $file = $request->shop_img;
        //数据表单验证
        $this->validate($request,[
            "shop_name"=>"required|max:50",
            "name"=>"required|max:50",
            "password"=>"required",
//            'shop_shop_img'=>"required",
            "start_send"=>"required",
            "repassword"=>"required",
            "email"=>"required",
            'captcha' => 'required|captcha',
        ],[
            "shop_name.required"=>"店铺名称不能为空！",
            "shop_name.max"=>"店铺名称不能超过50个字！",
            "name.required"=>"用户名不能为空！",
//            "$file.required"=>"店铺图片不能为空！",
            "password.required"=>"密码不能为空！",
            "repassword.required"=>"确认密码不能为空！",
            "start_send.required"=>"起送金额未填写！",
            "email.required"=>"邮箱未填写！",
            "send_cost.required"=>"配送费未填写！",
            "name.max"=>"用户名不能超过50个字！",
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if($request->password!=$request->repassword){
            session()->flash("danger","两次输入的密码不一致！");
            return redirect()->route("shops.create");

        }
        if(empty($file)){
            session()->flash("danger","必须上传店铺图片！");
            return redirect()->route("shops.create");
        }
        $filename= $file->store("public/logo");
        //评分
        $sore = $request->shop_rating??"";
        Shops::create(['shop_name'=>$request->shop_name,
            'shop_category_id'=>$request->shop_category_id,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'shop_rating'=>$sore,
            'status'=>1,
            'shop_img'=>$filename,
        ]);

        //跳转提示信息
        session()->flash("success","添加成功！");
        return redirect()->route("shops.index");
    }
//查看页面
    public function show(shops $shop)
    {
        $categories= ShopCategories::all();
        return view("shops/show",compact("shop","categories"));
    }
//修改回显
    public function edit(shops $shop)
    {
        $categories= ShopCategories::all();
        return view("shops/edit",compact("shop","categories"));
    }
//修改保存
    public function update(shops $shop,Request $request)
    {
        //数据表单验证
        $this->validate($request,[
            "shop_name"=>"required|max:50",
            "name"=>"required|max:50",

//            'shop_shop_img'=>"required",
            "start_send"=>"required",

            "email"=>"required",

        ],[
            "shop_name.required"=>"店铺名称不能为空！",
            "shop_name.max"=>"店铺名称不能超过50个字！",
            "name.required"=>"用户名不能为空！",



            "start_send.required"=>"起送金额未填写！",
            "email.required"=>"邮箱未填写！",
            "send_cost.required"=>"配送费未填写！",
            "name.max"=>"用户名不能超过50个字！",

        ]);


        //评分
        $sore = $request->shop_rating??"";

        $data=['shop_name'=>$request->shop_name,
            'shop_category_id'=>$request->shop_category_id,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'shop_rating'=>$sore,
            'status'=>$request->status,
        ];
        $file = $request->shop_img;
        if ($file) {
            $filename = $file->store("public/logo");
            $data=['shop_name'=>$request->shop_name,
                'shop_category_id'=>$request->shop_category_id,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'shop_rating'=>$sore,
                'status'=>1,
                'shop_img'=>$filename,
            ];
        }
        if($file==null){
            $filename="";
        }else{
            $filename= $file->store("public/logo");
        }
        $shop->update($data);
        //跳转提示信息
        session()->flash("success","更新成功！");
        return redirect()->route("shops.show",[$shop]);
    }
//删除
    public function destroy(Shops $shop)
    {
        $shop->delete();
        //跳转提示信息
        session()->flash("success","删除成功！");
        return redirect()->route("shops.index");
    }

}
