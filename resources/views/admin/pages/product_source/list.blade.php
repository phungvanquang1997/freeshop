@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.good_products')}}
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

            @include('admin.pages.product_source._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.supplier')}}</th>
                    <th>{{trans('lang.image')}}</th>
                    <th>{{trans('lang.name')}}</th>
                    <th>{{trans('lang.specie')}}</th>
                    <th>{{trans('lang.num_oder')}}</th>
                    <th>{{trans('lang.status')}}</th>
                    <th width="30px;"></th>
                </tr>
                </thead>
                <tbody>
                
                @foreach ($sources as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        
                        <td><img style="max-height: 35px" src="{{ \App\ProductSource::$logoOfBrand[$item->brand] }}" style="max-height: 35px; max-width: 100%;margin: 0;"></td>
                        <td><img style="max-width: 50px;" src="{{ MyHtml::showThumb($item->image, 'brand', 'small') }}"></td>
                        <td style="word-break: break-word;">{{ $item->name }}</td>
                        <td>
                            {{ $item->category->name }}
                        </td>
                        <td>{{ $item->order }}</td>
                        <td class="dropdown dropdown-withdraw-status">
                            <a class="dropdown-toggle" data-toggle="dropdown" title="{{trans('lang.click_to_change')}}">
                                {!! MyHtml::displayUserStatus($item->status) !!}
                            </a>
                            <ul class="dropdown-menu">
                                {!! \Form::open(['method' => 'PUT', 'url' => 'admin/product-source/status/' . $item->id, 'class' => 'form-horizontal form-status-' . $item->id]) !!}
                                <li>
                                    <label class="label label-success">
                                    {!! \Form::radio('status', \App\ProductSource::STATUS_ACTIVE, $item->status == \App\ProductSource::STATUS_ACTIVE, ['data-id' => $item->id]) !!}
                                    {{trans('lang.activate')}}
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-default">
                                    {!! \Form::radio('status', \App\ProductSource::STATUS_INACTIVE, $item->status  == \App\ProductSource::STATUS_INACTIVE, ['data-id' => $item->id]) !!}
                                    {{trans('lang.deactivate')}}
                                    </label></li>
                                {!! \Form::close() !!}
                            </ul>
                        </td>
                        <td>
                            <a href="{{ url('admin/product-source/' . $item->id  . '/edit/') }}"
                               class="btn btn-xs btn-default font14 btn-action" title="{{trans('lang.edit')}}"><i class="fa fa-pencil"></i></a>
                            {!! \Form::open(['method' => 'DELETE', 'url' => 'admin/product-source/' . $item->id, 'class' => 'inline']) !!}
                                <button type="submit" title="{{trans('lang.del')}}" onclick="return del_source_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                            {!! \Form::close() !!}
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

        function del_source_confirm()
        {
            var text = "{{trans('lang.del_source_confirm')}}";
            return confirm(text);
        }

    </script>

@stop

