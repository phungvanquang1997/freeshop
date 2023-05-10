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
                <a class="btn btn-primary" href="{{ url('admin/page/create') }}"><i class="fa fa-plus"></i> {{trans('lang.add_new')}}</a>
            </div>

            @include('admin.pages.pages._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.categories')}}</th>
                    <th>{{trans('lang.name')}}</th>
                    <th width="15%"></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($blogs))
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td></td>
                            <td>
                                <a href="{{ url('admin/page/' . $blog->id . '/edit') }}">{{ $blog->title }}</a>
                            </td>
                            <td>
                                {!! App\Helpers\MyHtml::btnEdit('admin/page/' . $blog->id . '/edit/') !!}
                                {!! App\Helpers\MyHtml::btnRemove('admin/page/' . $blog->id) !!}
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
                "order": []
            });
        });
    </script>

@stop

