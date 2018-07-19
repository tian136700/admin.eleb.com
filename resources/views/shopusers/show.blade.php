@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
    <tr class="text-center"><td><label>用户名</label></td></tr>
        <tr>

            <td>{{$shopuser->name}}</td>
        </tr>
        <tr class="text-center"><td><label>email</label></td></tr>
        <tr>
            <td>{{$shopuser->email}}</td>
        </tr>
        <tr class="text-center" ><td><label>所属商家</label></td></tr>
        <tr>
            <td>{{$shopuser->category->shop_name}}</td>
        </tr>
        <tr class="text-center" ><td><label>状态</label></td></tr>
        <td>{{$shopuser->status==1?"启用":"禁用"}}</td>
    </table>
@stop