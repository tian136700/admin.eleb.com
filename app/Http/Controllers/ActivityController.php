<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //查看活动列表页面
    public function index(Request $request)
    {
        //已结束页面
        if ($request->status == 0) {
            return response()->file('./activity/end.html');
        }
        if ($request->status == 1) {
            return response()->file('./activity/unfinished.html');
        }
        //返回数据
        return response()->file('./activity/index.html');
    }

    //增加数据
    public function create()
    {

        return view("activity/create");
    }

   //添加保存
    public function store(Request $request)
    {

        //数据表单验证
        $this->validate($request, [
            "title" => "required|max:50",
            "content" => "required",
            "start_time" => "required",
            "end_time" => "required",

        ], [
            "title.required" => "活动名称不能为空！",
            "title.max" => "活动名称不能超过50个字！",
            "content.required" => "内容不能为空！",
            "start_time.required" => "活动开始时间不能为空！",
            "end_time.required" => "活动结束时间不能为空！",
        ]);


        $data = ['title' => $request->title,
            'content' => $request->content,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ];
        Activity::create($data);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("activities.index");
    }

    //修改回显
    public function edit(Activity $activity)
    {

        return view("activity/edit", compact("activity"));
    }

    //修改保存
    public function update(Activity $activity, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "title" => "required|max:50",
            "content" => "required",
            "start_time" => "required",
            "end_time" => "required",

        ], [
            "title.required" => "活动名称不能为空！",
            "title.max" => "活动名称不能超过50个字！",
            "content.required" => "内容不能为空！",
            "start_time.required" => "活动开始时间不能为空！",
            "end_time.required" => "活动结束时间不能为空！",
        ]);


        $data = ['title' => $request->title,
            'content' => $request->content,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ];

        $activity->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("activities.show", [$activity]);
    }

    //查看页面
    public function show(Activity $activity)
    {
        //读取id
        $id = $activity->id;
        //返回数据
        return response()->file("./activity/" . $id . "show.html");
    }

    //删除
    public function destroy(Activity $activity)
    {
        $activity->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return back();
    }

    //一键生成或更新活动静态页
    public function activityStatic(Request $request)
    {
        //列表页
        $request->status = $request->status??2;
        if ($request->status == 2) {
            //全部
            $activities = Activity::Paginate(5);
            //静态化页面
            $contents = view("activity/index", compact("activities"));
            //生成静态化
            file_put_contents("./activity/index.html", $contents);
        } elseif ($request->status == 1) {
            //未结束
            $activities = Activity::where("status", "=", 1)->Paginate(5);
            //静态化页面
            $contents = view("activity/index", compact("activities"));
            //生成静态化
            file_put_contents("./activity/unfinished.html", $contents);

        } else {
            //已结束
            $activities = Activity::where("status", "=", 0)->Paginate(5);
            //静态化页面
            $contents = view("activity/index", compact("activities"));
            //生成静态化
            file_put_contents("./activity/end.html", $contents);
        }

        //显示页
        foreach ($activities as $activity) {
            //静态化页面
            $contents = view("activity/show", compact("activity"));
            //生成静态化
            file_put_contents("./activity/" . $activity->id . "show.html", $contents);
        }

    }

}
