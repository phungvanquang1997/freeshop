@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.withdraws')}}
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

            @include('admin.pages.withdraw._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.customer')}}</th>
                    <th>{{trans('lang.so_tai_khoan')}}</th>
                    <th>{{trans('lang.chu_tai_khoan')}}</th>
                    <th>{{trans('lang.ngan_hang')}}g</th>
                    <th>{{trans('lang.chi_nhanh')}}</th>
                    <th>{{trans('lang.sotien')}}</th>
                    <th>{{trans('lang.status')}}</th>
                    <th>{{trans('lang.date')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                
                @foreach ($withdraws as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->user_name }} : {{ $item->user_email }}
                        </td>
                        <td>{{ $item->bank_no }}</td>
                        <td>{{ $item->bank_owner }}</td>
                        <td>{{ $item->bank_name }}</td>
                        <td>{{ $item->bank_branch }}</td>
                        <td>{!! Currency::display($item->amount) !!}</td>
                        <td class="dropdown dropdown-withdraw-status">
                            <a class="dropdown-toggle" data-toggle="dropdown" title="{{trans('lang.click_to_change')}}">
                                {!! MyHtml::displayWithdrawStatus($item->status) !!}
                            </a>
                            <ul class="dropdown-menu">
                                {!! Form::open(['method' => 'PUT', 'url' => 'admin/withdraw/' . $item->id, 'class' => 'form-horizontal form-status-' . $item->id]) !!}
                                <li>
                                    <label class="label label-warning">
                                    {!! Form::radio('status', \App\Withdraw::STATUS_UNVERIDIED, $item->status == \App\Withdraw::STATUS_UNVERIDIED, ['data-id' => $item->id]) !!}
                                    Chưa xác minh
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-info">
                                    {!! Form::radio('status', \App\Withdraw::STATUS_VERIFIED, $item->status  == \App\Withdraw::STATUS_VERIFIED, ['data-id' => $item->id]) !!}
                                    Đã xác minh
                                    </label></li>
                                <li>
                                    <label class="label label-success">
                                    {!! Form::radio('status', \App\Withdraw::STATUS_SUCCESS, $item->status  == \App\Withdraw::STATUS_SUCCESS, ['data-id' => $item->id]) !!}
                                    Đã thanh toán
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-default">
                                    {!! Form::radio('status', \App\Withdraw::STATUS_INACTIVE, $item->status  == \App\Withdraw::STATUS_INACTIVE, ['data-id' => $item->id]) !!}
                                    Hủy bỏ
                                    </label>
                                </li>
                                {!! Form::close() !!}
                            </ul>
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/withdraw/' . $item->id, 'class' => 'inline']) !!}
                                <button type="submit" title="Xóa" onclick="return confirm('Bạn chăc chắn muốn xóa lịch sử rút tiền')" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
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

