<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    {!! Html::style('css/frontend/bootstrap.min.css') !!}
            <!-- Font Awesome Icons -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    {!! Html::style('css/frontend/AdminLTE.min.css') !!}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('css/frontend/skins/_all-skins.min.css') !!}
            <!-- jQuery 2.1.3 -->
    {!! Html::script('js/vendor/jquery/jquery-2.1.4.min.js') !!}
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <a href="/user" class="logo">{{Auth::user()->name}}</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav navbar-right">

                    @if (config('locale.status') && count(config('locale.languages')) > 1)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ trans('menus.language-picker.language') }}
                                <span class="caret"></span>
                            </a>

                            @include('includes.partials.lang')
                        </li>
                        @endif

                                <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li>{!! link_to('login', trans('navs.frontend.login')) !!}</li>
                            <li>{!! link_to('register', trans('navs.frontend.register')) !!}</li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>{!! link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard')) !!}</li>

                                    @if (access()->user()->canChangePassword())
                                        <li>{!! link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) !!}</li>
                                    @endif

                                    @permission('view-backend')
                                    <li>{!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}</li>
                                    @endauth

                                    <li>{!! link_to_route('auth.logout', trans('navs.general.logout')) !!}</li>
                                </ul>
                            </li>
                        @endif

                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->email}}</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a href="/user">
                        <i class="fa fa-dashboard"></i> <span>用户中心</span>
                    </a>
                </li>

                {{--<li>--}}
                {{--<a href="/user/node">--}}
                {{--<i class="fa fa-sitemap"></i> <span>节点列表</span>--}}
                {{--</a>--}}
                {{--</li>--}}

                <li>
                    <a href="/user/profile">
                        <i class="fa fa-user"></i> <span>我的信息</span>
                    </a>
                </li>


                <li>
                    <a href="/user/edit">
                        <i class="fa  fa-pencil"></i> <span>修改资料</span>
                    </a>
                </li>

                <li>
                    <a href="/user/invite">
                        <i class="fa fa-users"></i> <span>邀请好友</span>
                    </a>
                </li>

                <li>
                    <a href="/user/flow">
                        <i class="fa fa-align-left"></i> <span>网络流量</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    @yield('content')


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Made with Love
        </div>
        <strong>Copyright &copy; 2016 <a href="#">{{env('APP_NAME','Laravel')}}</a> </strong>
        All rights reserved. Powered by <b>Laravel</b> | <a href="/tos">服务条款 </a>
    </footer>
</div><!-- ./wrapper -->


<!-- Bootstrap 3.3.2 JS -->
{!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}
        <!-- SlimScroll -->
{!! Html::script('js/frontend/plugin/slimScroll/jquery.slimscroll.min.js') !!}
        <!-- FastClick -->
{!! Html::script('js/frontend/plugin/fastclick/fastclick.min.js') !!}
        <!-- AdminLTE App -->
{!! Html::script('js/frontend/adminLTE/app.min.js') !!}
</body>
</html>
