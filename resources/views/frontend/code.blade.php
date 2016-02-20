@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="section">
            <!--   Icon Section   -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="sub-header">{{ trans('labels.frontend.code.invite_code') }}</h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>###</th>
                            <th>{{ trans('labels.frontend.code.invite_code') }}</th>
                            <th>{{ trans('labels.frontend.code.state') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($codes as $key=>$code)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$code->code}}</td>
                                @if($code->email)
                                    <td>已用{{$code->email}}</td>
                                @else
                                    <td>可用</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div>
                    </div>
                </div>
                <br>
            </div>
@endsection