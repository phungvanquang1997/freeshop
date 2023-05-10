@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Quảng cáo: {{ $banner->name }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/banner') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{ $banner->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-2 pull-right text-right">
                    <a class="btn btn-primary" href="{{ url('admin/banner/item-create/' . $banner->id) }}">{{trans('lang.add_new')}}</a>
                </div>
            </div>
            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">ID</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.name')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1">Link</th>
                        <th tabindex="0" rowspan="1" colspan="1">Mô tả</th>
                        <th tabindex="0" rowspan="1" colspan="1">Hình ảnh</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.status')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$bannerItems->isEmpty())
                        @foreach ($bannerItems as $item)
                    
                        <tr>                          
                            <td class="sorting_1">{{ $item->id}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->link}}</td>
                            <td>{{ $item->description}}</td>
                            <td>
                                @if (strlen($item->image) > 0)
                                    <img src="{{ MyHtml::showThumb($item->image, 'banner') }}" alt="">
                                @endif
                            </td>
                            <td class="center">
                                @if($item->status == \App\Banner::STATUS_ACTIVE)
                                    <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                @else
                                    <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/banner/item-edit/' . $item->id) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.update')}}"><i class="fa fa-pencil"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'url' => 'admin/banner/item-delete/' . $item->id, 'class' => 'inline']) !!}
                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_menu_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                        Không có quảng cáo</td>
                    </tr>                        
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

