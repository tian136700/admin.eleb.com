<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use App\Models\Shops;
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
            'signup_start' => $request->signup_start,
            'signup_end' => $request->signup_end,
            'prize_date' => $request->prize_date,
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
            'signup_start' => $request->signup_start,
            'signup_end' => $request->signup_end,
            'prize_date' => $request->prize_date,
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

        $count = count($prizesId);
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

        }
//        dd($result);
//        $emcount = count($eventMembers);
//        $arr = $eventMembers;
//
//        //获取商家信息
//        $shops = Shops::all();
//        $lcount = count($shops);
//        for ($i = 0; $i < $lcount; $i++) {
//            for ($j = 0; $j < $emcount; $j++) {
//                if ($eventMembers[$j]["shop_id"] === $shops[$i]->id) {
//                    $arr[$j]["shop_name"] = $shops[$i]->shop_name;
//                }
//            }
//        }
//        //打乱数组
//        shuffle($arr);
//
//        $newArr = [];
////        dd($arr);
//        //弹出四个
//        for ($i = 0; $i < $count; $i++) {
//            $newArr[$i]["shop_name"] = $arr[$i]["shop_name"];
//            $newArr[$i]["events_id"] = $arr[$i]["events_id"];
//            $newArr[$i]["shop_id"] = $arr[$i]["shop_id"];
//            //加入中奖奖品
//            $newArr[$i]["prize"] = $prizes[$i]->name;
//            $prizes[$i]->update(["shop_id" => $arr[$i]["shop_id"]]);
//
//        }
        //把中奖信息写入数据表
        //更新活动表
        $event->update(['is_prize' => 1]);
        //调用发邮件的功能给商家发送邮件
//        $this->sendEmail("你中奖了","493701289@qq.com");
        //取出中奖奖品id和名称
        return view("event/result", compact("event", "newArr"));

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
