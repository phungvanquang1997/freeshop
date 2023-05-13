@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.categories')}}
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
            <div class="col-sm-2 pull-right text-right">
                <a class="btn btn-primary" href="{{ url('admin/category/article/create') }}"><i class="fa fa-plus"></i> {{trans('lang.add_new')}}</a>
            </div>

            <div class="row no-padding filter-container">
                {!! Form::open(['method' => 'GET', 'url' => url('admin/category/article')]) !!}
                <div class="col-sm-2">
                    <input name="name" type="text" class=" form-control" value="{{ request()->has('name') ? request()->get('name') : '' }}" placeholder="Tên danh mục">
                </div>    
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
                {!! Form::close() !!}
            </div>

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('lang.name')}}</th>
                    <th>Slug</th>
                    <th>{{trans('lang.cate_parent')}}</th>
                    <th>{{trans('lang.num_oder')}}</th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($parents))

                    @foreach ($parents as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td></td>
                            <td>{{ $category->order }}</td>
                            <td>
                                {!! App\Helpers\MyHtml::btnEdit('admin/category/article/' . $category->id . '/edit/') !!}
                                {!! App\Helpers\MyHtml::btnRemove('admin/category/article/' . $category->id) !!}
                            </td>
                        </tr>

                        @foreach ($category->children()->orderBy('order', 'asc')->get() as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>{{ '|-- ' . $child->name }}</td>
                                <td>{{ $child->slug }}</td>
                                <td>{{ $category->name or null }}</td>
                                <td>{{ $child->order }}</td>
                                <td>
                                    {!! App\Helpers\MyHtml::btnEdit('admin/category/article/' . $child->id . '/edit/') !!}
                                    {!! App\Helpers\MyHtml::btnRemove('admin/category/article/' . $child->id) !!}
                                </td>
                            </tr>

                            @foreach ($child->children()->orderBy('order', 'asc')->get() as $grandson)
                                <tr>
                                    <td>{{ $grandson->id }}</td>
                                    <td>{{ '|--|-- ' . $grandson->name }}</td>
                                    <td>{{ $grandson->slug }}</td>
                                    <td>{{ $child->name or null }}</td>
                                    <td>{{ $grandson->order }}</td>
                                    <td>
                                        {!! App\Helpers\MyHtml::btnEdit('admin/category/article/' . $grandson->id . '/edit/') !!}                                    
                                        {!! Form::open(['method' => 'DELETE', 'url' => 'admin/category/article/' . $grandson->id, 'class' => 'inline']) !!}
                                            <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_cate_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        @endforeach

                    @endforeach
                @else
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent->name or null }}</td>
                            <td>{{ $category->order }}</td>
                            <td>
                                {!! App\Helpers\MyHtml::btnEdit('admin/category/article/' . $category->id . '/edit/') !!}
                                {!! App\Helpers\MyHtml::btnRemove('admin/category/article/' . $category->id) !!}
                            </td>
                        </tr>
                    @endforeach
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
        function del_cate_confirm()
        {
            var text = "{{trans('lang.del_cate_confirm')}}";
            return confirm(text);
        }
    </script>

@stop

