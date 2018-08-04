@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">


        <tr class="text-center" style="font-size:24px;color: red;font-family:sans-serif;">
            <td colspan="7"><label>中奖结果：</label></td>
            @foreach($eventPrizes as $eventPrize)
        </tr>
        <tr class="text-center">
            <td colspan="3"><label>中奖商家：<span
                            style="font-size:24px;color: red;font-family:sans-serif;">{{$eventPrize->shop->shop_name}}</span></label>
            </td>
            <td colspan="4"><label>奖品：<span
                            style="font-size:24px;color: red;font-family:sans-serif;">{{$eventPrize->name}}</span></label>
            </td>
        </tr>
        @endforeach

    </table>
@stop