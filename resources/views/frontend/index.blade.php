@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                        <div class="thumbnail">

                            <div class="caption">
                                <div class="img-responsive center-block">
                                    {!! QrCode::size(300)->generate($publicSS) !!}
                                </div>
                                <h3>
                                    公共账号信息
                                    <small>（密码不定期更换）</small>
                                </h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-solid">
                                            <div class="box-header">
                                                <h4 class="box-title">今日流量使用情况</h4>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar"
                                                         aria-valuenow="40"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width: {{$user->trafficUsagePercent()}}%">
                                                        <span class="sr-only">Transfer</span>
                                                    </div>
                                                </div>
                                                <p> 总流量:{{$user->getTotalTransfer()}}</p>
                                                <p> 已用流量：{{$user->getUsedTransfer()}}  </p>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div>
                                </div>
                                <p>
                                    <a class="btn btn-primary btn-block" href="/register">注册</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>

            {{--<div class="col-md-12">--}}
            {{--<blockquote class="pull-right">--}}
            {{--<p>--}}
            {{--<small>--}}
            {{--这是最好的时代，这是最坏的时代，这是智慧的时代，这是愚蠢的时代；这是信仰的时期，这是怀疑的时期；--}}
            {{--</small>--}}
            {{--</p>--}}
            {{--<small>狄更斯 <cite>《双城记》</cite></small>--}}
            {{--</blockquote>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection