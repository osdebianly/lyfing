@extends('frontend.user.main')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                个人资料
                <small>Profile</small>
            </h1>
        </section>
        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <p>用户名：{{$user->name}}</p>
                            <p>邮箱：{{$user->email}}</p>
                            <p>注册时间：{{$user->created_at}}</p>
                            <p>上次签到时间：{{date('Y-m-d H:i',$user->last_check_in_time)}}</p>

                            <p><a class="btn btn-danger btn-sm" href="destroy">删除我的账户</a></p>
                            <p></p>
                        </div><!-- /.box -->
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection