<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{

    //主页
    public function index()
    {

        $eventprizes = EventPrize::Paginate(5);

        return view("eventprize/index", compact("eventprizes"));
    }

//增加数据
    public function create()
    {
        $events = Event::all();
        return view("eventprize/create", compact("events"));
    }

//添加保存
    public function store(Request $request)
    {

        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",
            "description" => "required",

        ], [
            "name.required" => "奖品名称不能为空！",
            "name.max" => "奖品名称不能超过50个字！",
            "description.required" => "奖品详情不能为空！",

        ]);
        //组成要写入的数据
        $data = ['name' => $request->name,
            'description' => $request->description,
            'events_id' => $request->events_id,

        ];

        //写入数据
        EventPrize::create($data);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("eventprizes.index");

    }



//修改回显
    public function edit(eventprize $eventprize)
    {
        $events = Event::all();
        return view("eventprize/edit", compact("eventprize","events"));
    }

//修改保存
    public function update(eventprize $eventprize, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "name" => "required|max:50",
            "description" => "required",

        ], [
            "name.required" => "奖品名称不能为空！",
            "name.max" => "奖品名称不能超过50个字！",
            "description.required" => "奖品详情不能为空！",

        ]);
        //组成要写入的数据
        $data = ['name' => $request->name,
            'description' => $request->description,
            'signup_start' => $request->signup_start,
            'signup_end' => $request->signup_end,
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'is_prize' => $request->is_prize??0,
        ];
        $eventprize->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("eventprizes.show", [$eventprize]);
    }

//删除
    public function destroy(EventPrize $eventprize)
    {
        $eventprize->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("eventprizes.index");
    }
}
