<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{

    //主页
    public function index(Request $request)
    {
        //获取抽奖活动名称
        $event_id = $request->id;
        //获取是否开奖状态
        $status = Event::where("id", $event_id)->first()->is_prize;
        $eventprizes = EventPrize::where("events_id", $request->id)->Paginate(5);

        return view("eventprize/index", compact("eventprizes", "status", "event_id"));
    }

//增加数据
    public function create(Request $request)
    {
        //获取抽奖活动id
        $event_id = $request->event_id;

        $event = Event::find($event_id);

        return view("eventprize/create", compact("event"));
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
        return redirect()->route("eventprizes.index", ["id" => $request->events_id]);

    }


//修改回显
    public function edit(EventPrize $eventprize)
    {
        $event=Event::find($eventprize->events_id);
        return view("eventprize/edit", compact("eventprize", "event"));
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
        return redirect()->route("eventprizes.index", ["id"=>$eventprize->events_id]);
    }

//删除
    public function destroy(EventPrize $eventprize)
    {
        $eventprize->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("eventprizes.index", ["id"=>$eventprize->events_id]);
    }
}
