@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.payments')}}
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

            @include('admin.pages.payment._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.customer')}}</th>
                    <th>{{trans('lang.email')}}</th>
                    <th>{{trans('lang.specie')}}</th>
                    <th>{{trans('lang.sotien')}}</th>
                    <th>{{trans('lang.pay_method')}}</th>
                    <th>{{trans('lang.content')}}</th>
                    <th>{{trans('lang.date')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                
                @foreach ($payments as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->user_name }}
                        </td>
                        <td>{{ $item->user_email }}</td>
                        <td>{!! MyHtml::displayPaymentType($item->type) !!}</td>
                        <td>{{ number_format($item->amount) }}</td>
                        <td>{{ $item->type == \App\Payment::TYPE_PAY ? trans(\App\Payment::$methods[$item->method]) : null }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                        <td>
                            @if (Auth::user()->group == App\User::IS_ADMINISTRATOR)
                            {!! \Form::open(['method' => 'DELETE', 'url' => 'admin/payment/' . $item->id, 'class' => 'inline']) !!}
                                <button type="submit" title="{{trans('lang.del')}}" onclick="return del_payment_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                            {!! \Form::close() !!}
                            @endif

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
        });
        function del_payment_confirm()
        {
            var text = "{{trans('lang.del_payment_confirm')}}";
            return confirm(text);
        }
    </script>

@stop

