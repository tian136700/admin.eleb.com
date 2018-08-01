@extends('default')
@section("contents")
    <div>
        <h1 class="text-center">菜品统计</h1>
        <div class="row" style="float: right;width: 70%;">

            <form action="{{route("countmenus.index")}}" method="get">
                搜索类型：
                <select name="type" id="">
                    <option value="">--请选择商家--</option>
                    @foreach($shops as $shop)
                    <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                        @endforeach
                </select>
                按日搜索：<input type="date" name="day">&emsp;
                按月搜索：<select name="month" id="">
                    <option value="">月份</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                {{csrf_field()}}
                &emsp;
                <button type="submit" class="btn btn-default">搜索</button>

            </form>
        </div>


            </div>
    @if($type!="")
        <h3 class="text-center"></h3>
        <table class="table table-bordered table-responsive" style="width: 88%;float: right">
            <tr class="text-center">
                <th class="text-center">菜品名</th>
                <th>按日统计(默认显示当日)</th>
                <th>按月统计(默认显示当月)</th>
                <th>总计</th>
            </tr>
            @foreach($Marr as $value)
                <tr>
                    <td>{{$value["goods_name"]}}</td>

                    <td>{{$value["dayCount"]}}</td>
                    <td>{{$value["monthCount"]}}</td>
                    <td>{{$value["total"]}}</td>

                </tr>

            @endforeach
        </table>
    @endif

        </div>
    </div>

@endsection