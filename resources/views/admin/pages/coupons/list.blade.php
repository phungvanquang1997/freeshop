@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Phiếu giảm giá
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
            <div class="row">
                <div class="col-sm-2 pull-right text-right">
                    @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR)
                    <a class="btn btn-primary" href="{{ url('admin/coupons/create') }}">{{trans('lang.add_new')}}</a>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">ID</th>
                        <th tabindex="0" rowspan="1" colspan="1">Mã khuyến mại</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.name')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1">Giá trị</th>
                        <th tabindex="0" rowspan="1" colspan="1">Loại</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.status')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($coupons))
                        @foreach ($coupons as $item)
                    
                        <tr>                          
                            <td class="sorting_1">{{ $item->id}}</td>
                            <td>{{ $item->voucher}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->value}}</td>
                            <td>{{ App\Coupons::$types[$item->type] }}</td>
                            <td class="center">
                                @if($item->status == \App\Coupons::STATUS_ACTIVE)
                                    <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                @else
                                    <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/coupons/' . $item->id ) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.view_now')}}"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('admin/coupons/' . $item->id  . '/edit/') }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.update')}}"><i class="fa fa-pencil"></i></a>
                                <form method="POST" action="admin/coupons/{{ $item->id }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_coupons_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                                          
                    @endif                   
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer-content')
    <script>
        $(function () {
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [1,2]
            });

            $('.select-type').on('change', function () {
                $(location).attr('href', '{{ URL::current() }}?type=' + $(this).val());
            });
        });
        function del_menu_confirm()
        {
            var text = "{{trans('lang.del_menu_confirm')}}";
            return confirm(text);
        }

    </script>

@stop

