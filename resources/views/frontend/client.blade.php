@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 center">
                        <img alt="Bootstrap Image Preview" src="/img/windows-circle.png"
                             class="img-circle img-responsive center-block"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="/download/Shadowsocks-win-2.5.6.zip">
                            {!! trans('buttons.frontend.local_download') !!}
                        </a>
                    </div>
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="//github.com/shadowsocks/shadowsocks-csharp/releases/download/2.5.6/Shadowsocks-win-2.5.6.zip">
                            {!! trans('buttons.frontend.github_download') !!}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 center">
                        <img alt="Bootstrap Image Preview" src="/img/mac_os_x-circle.png"
                             class="img-circle img-responsive center-block"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="/download/ShadowsocksX-2.6.3.dmg">
                            {!! trans('buttons.frontend.local_download') !!}
                        </a>
                    </div>
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="//sourceforge.net/projects/shadowsocksgui/files/dist/ShadowsocksX-2.6.3.dmg">
                            {!! trans('buttons.frontend.sourceforge_download') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h1></h1>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 center">
                        <img alt="Bootstrap Image Preview" src="/img/android-circle.png"
                             class="img-circle img-responsive center-block"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="/download/shadowsocks-nightly-2.8.3.apk">
                            {!! trans('buttons.frontend.local_download') !!}
                        </a>
                    </div>
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="//play.google.com/store/apps/details?id=com.github.shadowsocks">
                            {!! trans('buttons.frontend.googleplay_download') !!}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 center">
                        <img alt="Bootstrap Image Preview" src="/img/apple-circle.png"
                             class="img-circle img-responsive center-block"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="//apt.thebigboss.org/onepackage.php?bundleid=com.linusyang.shadowsocks">
                            {!! trans('buttons.frontend.break_download') !!}
                        </a>
                    </div>
                    <div class="col-md-6">

                        <a type="button" class="btn btn-info btn-lg center-block"
                           href="//itunes.apple.com/tc/app/shadowsocks/id665729974?mt=8">
                            {!! trans('buttons.frontend.appstore_download') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection