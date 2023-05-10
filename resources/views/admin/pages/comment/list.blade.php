@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Bình luận
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
            <div class="">
                @include('admin.pages.comment._filter')
                
            </div>
            <table id="data-table" class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">ID</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.name')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1">Email</th>
                        <th tabindex="0" rowspan="1" colspan="1" width="40%">Nội dung</th>
                        <th class="text-center" tabindex="0" rowspan="1" colspan="1">Số sao</th>
                        <th class="text-center" tabindex="0" rowspan="1" colspan="1">{{trans('lang.status')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($comments))
                        @foreach ($comments as $item)
                    
                        <tr>                          
                            <td class="sorting_1">{{ $item->id}}</td>
                           
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email}}</td>
                            <td>{{ $item->content}}</td>
                            <td class="text-center">{{ $item->star}}</td>
                            <td class="text-center">
                                {!! \Form::open(['method' => 'PUT', 'url' => 'admin/comment/' . $item->id, 'class' => 'inline']) !!}
                                
                                @if($item->status == 1)
                                <button type="submit" data-toggle="tooltip" title="Vô hiệu" class="btn-link font14">
                                    <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                @else
                                <button type="submit" data-toggle="tooltip" title="Kích hoạt" class="btn-link font14">
                                    <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                @endif
                                </button>
                                {!! \Form::close() !!}
                            </td>
                            <td>
                                {!! \Form::open(['method' => 'DELETE', 'url' => 'admin/comment/' . $item->id, 'class' => 'inline']) !!}
                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_coupons_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                {!! \Form::close() !!}
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

