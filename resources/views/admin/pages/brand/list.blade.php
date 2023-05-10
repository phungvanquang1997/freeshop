@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Brand
            <small>listing</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="{{ url('admin/brand') }}">Brands</a></li>
            <li class="active"><a href="#">Brand list</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Total product</th>
                    <th>Order</th>
                    <th width="15%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{!! Html::image(App\Helpers\MyHtml::showThumb($brand->logo, 'brand'), '') !!}</td>
                        <td><a target="_blank" href="{{ $brand->website }}">{{ $brand->website }}</a></td>
                        <td>{{ $brand->total_products }}</td>
                        <td>{{ $brand->order }}</td>
                        <td>
                            {!! App\Helpers\MyHtml::btnEdit('admin/brand/' . $brand->id . '/edit/') !!}
                            {!! App\Helpers\MyHtml::btnRemove('admin/brand/' . $brand->id) !!}
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

