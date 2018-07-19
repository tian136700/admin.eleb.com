<?php

namespace App\Http\Controllers;

use App\Models\ShopCategories;
use Illuminate\Http\Request;

class ShopCategoriesController extends Controller
{
    //店铺分类页
    public function index()
    {
        $shopcategories = ShopCategories::all();
        return view("shopcategories/index", compact("shopcategories"));
    }

    //增加数据
    public function create()
    {
        return view("shopcategories/create");
    }

    //添加保存
    public function store(Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:20",

        ], [
            "name.required" => "分类名称不能为空！",
            "name.max" => "标题不能超过20个字！"
        ]);
        //对用户上传的图片进行验证
        $data=['name' => $request->name,
                'status' => $request->status,
                'img'=> ""
            ];
        //进行判断
        $file = $request->img;
        if ($file) {
            $filename = $file->store("public/logo");
            $data=['name' => $request->name,
                'status' => $request->status,
                    'img'=>$filename
            ];
        }
        ShopCategories::create($data);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("shopcategories.index");
    }

    //修改回显
    public function edit(shopCategories $shopcategory)
    {
        return view("shopcategories/edit", compact("shopcategory"));
    }

    //修改保存
    public function update(shopCategories $shopcategory, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:20",

        ], [
            "name.required" => "分类名称不能为空！",
            "name.max" => "标题不能超过10个字！"
        ]);
        //对用户上传的图片进行验证
        $data=['name' => $request->name,
            'status' => $request->status,
            'img'=> ""
        ];
        //进行判断
        $file = $request->img;
        if ($file) {
            $filename = $file->store("public/logo");
            $data=['name' => $request->name,
                'status' => $request->status,
                'img'=>$filename
            ];
        }
        $shopcategory->update(
           $data
        );
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("shopcategories.index");
    }
    //删除
    public function destroy(shopCategories $shopcategory)
    {

        $shopcategory->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("shopcategories.index");
    }
}
