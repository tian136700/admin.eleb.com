<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use App\Models\Shops;
use App\Models\ShopUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    //主页
    public function index()
    {

        $events = Event::Paginate(5);

        return view("event/index", compact("events"));
    }

    //增加数据
    public function create()
    {
        return view("event/create");
    }

    //添加保存
    public function store(Request $request)
    {
//        dd($request->signup_start);
        //数据表单验证
        $this->validate($request, [
            "title" => "required|max:50",
            "content" => "required",

        ], [
            "title.required" => "标题不能为空！",
            "title.max" => "标题不能超过50个字！",
            "content.required" => "内容详情不能为空！",

        ]);
        //组成要写入的数据
        $data = ['title' => $request->title,
            'content' => $request->content,
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => strtotime($request->signup_end),
            'prize_date' => strtotime($request->prize_date),
            'signup_num' => $request->signup_num,
            'is_prize' => $request->is_prize??0,
        ];

        //写入数据
        Event::create($data);
        //跳转提示信息
        session()->flash("success", "添加成功！");
        return redirect()->route("events.index");

    }

    //查看页面
    public function show(Event $event)
    {

        //抽奖状态
        $arr = "";
        return view("event/show", compact("event", "arr"));
    }

    //修改回显
    public function edit(Event $event)
    {

        return view("event/edit", compact("event"));
    }

    //修改保存
    public function update(Event $event, Request $request)
    {
        //数据表单验证
        $this->validate($request, [
            "title" => "required|max:50",
            "content" => "required",

        ], [
            "title.required" => "标题不能为空！",
            "title.max" => "标题不能超过50个字！",
            "content.required" => "内容详情不能为空！",

        ]);
        //组成要写入的数据
        $data = ['title' => $request->title,
            'content' => $request->content,
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => strtotime($request->signup_end),
            'prize_date' => strtotime($request->prize_date),
            'signup_num' => $request->signup_num,
            'is_prize' => $request->is_prize??0,
        ];
        $event->update($data);
        //跳转提示信息
        session()->flash("success", "更新成功！");
        return redirect()->route("events.show", [$event]);
    }

    //删除
    public function destroy(Event $event)
    {
        $event->delete();
        //跳转提示信息
        session()->flash("success", "删除成功！");
        return redirect()->route("events.index");
    }

    //抽奖结果
    public function eventResult(Event $event)
    {
        //获取活动奖品
        $prizesId = EventPrize::where("events_id", $event->id)->select("id")->get()->toArray();

        //把二维数组变成一维数组
        $prizesId = array_column($prizesId, 'id');
        //取出报名商家id
        $eventMembersId = EventMember::where("events_id", $event->id)->select("shop_id")->get()->toArray();
        //把二维数组变成一维数组
        $eventMembersId = array_column($eventMembersId, 'shop_id');

        //打乱数组
        shuffle($prizesId);
        shuffle($eventMembersId);
        //中奖结果
        $result = [];
        foreach ($prizesId as $key => $value) {
            if (empty($eventMembersId[$key])) break;
            $result[$value] = $eventMembersId[$key];
            //把获奖信息更新入得奖表
            EventPrize::where("id", $prizesId[$key])->update(["shop_id" => $result[$value]]);
            //把获奖信息发送给用户
            //获取用户邮箱
            $email = ShopUsers::where("shop_id", $result[$value])->select("email")->first()->email;
            //发送邮件给用户
            $this->sendEmail("你中奖了", $email);
        }

        //更新抽奖状态;
        $event->update(['is_prize' => 1]);
        //查询得奖表里面的信息
        $eventPrizes = EventPrize::where("events_id", $event->id)->get();

        //取出中奖奖品id和名称
        return view("event/result", compact("eventPrizes"));

    }

    //发送邮件
    public function sendEmail($content, $userEmail)
    {
        Mail::raw($content, function ($message) use ($userEmail) {

            $message->subject("您中奖了！");
            $message->to($userEmail);
            $message->from("18502821645@163.com", "18502821645");
        });

    }
}
