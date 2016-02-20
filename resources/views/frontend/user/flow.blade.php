@extends('frontend.user.main')
@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            流量信息
            <small>flow</small>
        </h1>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <table class="table">
                <thead>
                <tr>
                    <th data-field="date">日期</th>
                    <th data-field="flow">总流量值</th>
                    {{--<th data-field="reset_time">最后使用时间</th>--}}
                </tr>
                </thead>

                <tbody>
                @foreach($flows as $flow)
                    <tr>
                        <td>{{ date('Y-m-d',strtotime($flow->created_at))  }}</td>
                        <td>{{\App\Helpers\Tools::flowAutoShow($flow->flow)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $("#invite").click(function () {
            $.ajax({
                type: "POST",
                url: "makeInviteCode",
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                },
                error: function (jqXHR) {
                    alert("发生错误：" + jqXHR.status);
                }
            })
        })
    })
</script>

@endsection