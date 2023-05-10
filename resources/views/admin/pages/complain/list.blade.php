@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.complain')}}
            <small>{{trans('lang.list')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="#">{{trans('lang.list')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            @include('admin.pages.complain._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.customer')}}</th>
                    <th>{{trans('lang.email')}}</th>
                    <th>{{trans('lang.phone')}}</th>
                    <th>{{trans('lang.order_code')}}</th>
                    <th>{{trans('lang.type_complain')}}</th>
                    <th>{{trans('lang.status')}}</th>
                    <th>{{trans('lang.created_date')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                @foreach ($complains as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            {{ $item->user_name }}
                        </td>
                        <td>{{ $item->user_email }}</td>
                        <td>{{ $item->user_phone }}</td>
                        <td><a href="{{ url('admin/order_shipping/' . $item->order_id) }}" title="{{trans('lang.view')}}" data-toggle="tooltip">{{ isset($item->order->order_code) ? $item->order->order_code : null }}</a></td>
                        <td>{{ trans($species[$item->specie]) }}</td>
                        <td class="dropdown dropdown-withdraw-status">
                            <a class="dropdown-toggle" data-toggle="dropdown" title="Bấm chọn để thay đổi trạng thái">
                                {!! MyHtml::displayComplainStatus($item->status) !!}
                            </a>
                            <ul class="dropdown-menu">
                                {!! Form::open(['method' => 'PUT', 'url' => 'admin/complain/update-status/' . $item->id, 'class' => 'form-horizontal form-status-' . $item->id]) !!}
                                <li>
                                    <label class="label label-warning">
                                    {!! Form::radio('status', \App\Complain::STATUS_PENDING, $item->status == \App\Complain::STATUS_PENDING, ['data-id' => $item->id]) !!}
                                    {{trans(\App\Complain::$status[\App\Complain::STATUS_PENDING])}}
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-info">
                                    {!! Form::radio('status', \App\Complain::STATUS_PROCESS, $item->status  == \App\Complain::STATUS_PROCESS, ['data-id' => $item->id]) !!}
                                     {{trans(\App\Complain::$status[\App\Complain::STATUS_PROCESS])}}
                                    </label></li>
                                <li>
                                    <label class="label label-success">
                                    {!! Form::radio('status', \App\Complain::STATUS_SOLVED, $item->status  == \App\Complain::STATUS_SOLVED, ['data-id' => $item->id]) !!}
                                     {{trans(\App\Complain::$status[\App\Complain::STATUS_SOLVED])}}
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-default">
                                    {!! Form::radio('status', \App\Complain::STATUS_INACTIVE, $item->status  == \App\Complain::STATUS_INACTIVE, ['data-id' => $item->id]) !!}
                                     {{trans(\App\Complain::$status[\App\Complain::STATUS_INACTIVE])}}
                                    </label>
                                </li>
                                {!! Form::close() !!}
                            </ul>
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                        <td width="90px">
                            {!! Form::open(['url' => '/api/chat-rooms/' . $item->order_id, 'method' => 'POST', 'class' => 'inline', 'style' => 'display:inline-block', 'target' => '_blank']) !!}
                            <button type="submit" class="btn btn-xs btn-warning font14" data-toggle="tooltip" title="Chat với khách hàng">
                                <i class="fa fa-comment"></i>
                            </button>
                            {!! Form::close() !!}
                            @if ($item->status != \App\Complain::STATUS_SOLVED && $item->status != \App\Complain::STATUS_INACTIVE)
                                <a href="{{ url('admin/complain/' . $item->id) }}" class="btn btn-default btn-xs font14" data-toggle="tooltip" title="{{trans('lang.view_now')}}"><i class="fa fa-edit"></i></a> 
                            @endif
                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/complain/' . $item->id, 'class' => 'inline']) !!}
                                <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return confirm('Bạn chăc chắn muốn xóa đơn khiếu nại này?')" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer-content')
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": []
            });

            $('.dropdown-withdraw-status input[type=radio]').change(function(){
                var item = $(this).attr('data-id');
                $('form.form-status-' + item).submit();
            });
        });

    </script>

@stop

