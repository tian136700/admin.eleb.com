@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
    <tr class="text-center" ><td colspan="7"><label>用户名</label></td></tr>
        <tr>

            <td colspan="7">{{$member->username}}</td>
        </tr>
        <tr class="text-center"><td colspan="7"><label>电话</label></td></tr>
        <tr>
            <td colspan="7">{{$member->tel}}</td>
        </tr>

        <tr class="text-center"><td colspan="7"><label>创建时间</label></td></tr>
        <tr>
            <td colspan="7">{{$member->created_at}}</td>
        </tr>

        <tr class="text-center"><td colspan="3"><label>最后修改时间</label></td>
        </tr>
        <tr class="text-center">
            <td colspan="3">{{$member->updated_at}}</td>
        </tr>

    </table>
@stop