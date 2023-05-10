@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.news')}}
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
            <div class="pull-right text-right">
                <a class="btn btn-primary" href="{{ url('admin/article/create') }}"><i class="fa fa-plus"></i> {{trans('lang.add_new')}}</a>
                <a class="btn btn-primary" href="{{ url('admin/category/article') }}"><i class="fa fa-navicon"></i> Danh mục</a>
            </div>

            @include('admin.pages.cms.blog._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.categories')}}</th>
                    <th>{{trans('lang.name')}}</th>
                    <th width="100">{{trans('lang.image')}}</th>
                    <th width="15%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->category->name }}</td>
                        <td>
                            <a href="{{ url('admin/blog/' . $blog->id . '/edit') }}">{{ $blog->title }}</a>
                        </td>
                        <td>
                            <a target="_blank" href="{{ \App\Helpers\MyHtml::showImage($blog->image, 'blog') }}">
                                <img class="blog-list-image" src="{{ \App\Helpers\MyHtml::showImage($blog->image, 'blog') }}" />
                            </a>
                        </td>
                        <td>
                            {!! App\Helpers\MyHtml::btnEdit('admin/blog/' . $blog->id . '/edit/') !!}
                            {!! App\Helpers\MyHtml::btnRemove('admin/blog/' . $blog->id) !!}
                        </td>
                    </tr>
                @endforeach
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
                "order": []
            });
        });
    </script>

@stop

