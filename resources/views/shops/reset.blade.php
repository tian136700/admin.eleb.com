@extends("default")
@section("contents")
    <form action="{{route("shops.updatereset",[$shop])}}" method="post"  enctype="multipart/form-data">

    <h1 class="text-center">重置密码</h1>
    @include("_errors")
    <table class="table table-bordered table-responsive">
        <tr class="text-center" ><td colspan="7"><label>商家名</label></td></tr>
        <tr>

            <td colspan="7">{{$shop->shop_name}}</td>
        </tr>
        <tr class="text-center"><td colspan="7"><label>账号名</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->name}}</td>
        </tr>

        <tr class="text-center"><td colspan="7"><label>email</label></td></tr>
        <tr>
            <td colspan="7">{{$shop->email}}</td>
        </tr>

    </table>
    <label class="col-xs-2 control-label">密码</label>
    <div class="form-group">

        <input type="password" name="password" style="width: 500px" class="form-control" value=""/>
    </div>
    <label class="col-xs-2 control-label">确认密码</label>
    <div class="form-group">

        <input type="password" name="repassword" style="width: 500px" class="form-control" value=""/>
    </div>
    {{csrf_field()}}
    <button class="btn btn-primary">提交</button>
    </form>
@stop
