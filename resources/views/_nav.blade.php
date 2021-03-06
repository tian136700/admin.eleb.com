<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">后台首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    {!!\App\Models\Nav::getNavHtml()!!}

                <ul class="nav navbar-nav navbar-right">
                    @guest
                    <li><a href="" data-toggle="modal" data-target="#myModal">登陆</a></li>
                    @endguest
                    @auth

                    <li><a href="#" data-toggle="modal" data-target="#myModal"></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}} <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            <li role="separator" class="divider"></li>
                                <li class="btn-link"><a href="{{route("logout")}}">注销</a></li>

                        </ul>
                    </li>
                    @endauth
                </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel " data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">用户名密码登陆</h4>
            </div>
            <div class="modal-body ">
                <form action="{{route("login")}}" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="手机/邮箱/用户名">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="密码">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="1">下次自动登陆
                        </label>
                    </div>
                    {{csrf_field()}}
                    <input type="submit" class="btn btn-primary btn-block">
                </form>
            </div>
            <div class="modal-footer">
                <a href="" style="float: left">扫码登陆</a><a href="">立即注册</a>
            </div>
        </div>
    </div>
</div>
{{--@include("_errors")--}}