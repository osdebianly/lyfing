@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>{{ trans('strings.backend.flow.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.transfer_enable') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.t') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{!! $user->id !!}</td>
                            <td>{!! $user->name !!}</td>
                            <td>{!! link_to("mailto:".$user->email, $user->email) !!}</td>
                            <td class="visible-lg">{{\App\Helpers\Tools::flowAutoShow($user->transfer_enable)}}</td>
                            <td class="visible-lg">{{\App\Helpers\Tools::flowAutoShow($user->t)}}</td>
                            <td>
                                <a class="btn btn-warning"
                                   href="{{route('admin.flow.update',['user'=>$user->id,'flow'=>1])}}">+ 1G</a>
                                <a class="btn btn-warning"
                                   href="{{route('admin.flow.update',['user'=>$user->id,'flow'=>5])}}">+ 5G</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}
            </div>

            <div class="pull-right">
                {!! $users->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->

    </div><!--box-->

@endsection