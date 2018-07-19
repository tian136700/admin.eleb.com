@extends("default")
@section("contents")
    <table class="table table-bordered table-responsive">
    <tr class="text-center"><td><label>用户名</label></td></tr>
        <tr>

            <td>{{$user->name}}</td>
        </tr>
        <tr class="text-center"><td><label>email</label></td></tr>
        <tr>
            <td>{{$user->email}}</td>
        </tr>
        <tr class="text-center" ><td><label>头像</label></td></tr>
        <tr>
            <td><img width="100" height="100" src="{{\Illuminate\Support\Facades\Storage::url($user->logo)}}" alt=""></td>
        </tr>
    </table>
@stop