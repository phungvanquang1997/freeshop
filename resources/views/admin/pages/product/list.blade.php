@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Sản phẩm
            <small>danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li class="active"><a href="#">Danh sách</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
             
            <div class="pull-right text-right">
                <a class="btn btn-primary" href="{{ url('admin/product/create') }}"><i class="fa fa-plus"></i> {{trans('lang.add_new')}}</a>
                <a class="btn btn-primary" href="{{ url('admin/category/product') }}"><i class="fa fa-navicon"></i> Danh mục</a>
            </div>

            @include('admin.pages.product._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="40">ID</th>
                    <th>Tên sản phẩm</th>
                    <th width="90">Hình ảnh</th>
                    <th>Model</th>
                    <th width="15%">Danh mục</th>
                    <th>Giá (đ)</th>
                    <th>Nổi bật</th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)                
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <a href="{{ url('admin/product/' . $product->id . '/edit/') }}">{{ $product->name }}</a>
                        </td>
                        <td class="text-center">
                            @if (isset($product->mainImage()->image))
                            <img width="50" src="{{ MyHtml::showThumb($product->mainImage()->image, 'product') }}" alt="">
                            @endif
                        </td>
                        <td>{{ $product->model }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>{!! $product->is_featured == 1 ? '<span class="label label-danger">Nổi bật</span>' : '' !!}</td>
                        <td>{!! $product->stock_status == 'in_stock' ? '<span class="label label-danger">Còn hàng</span>' : 'Hết hàng' !!}</td>
                        <td>{!! $product->status == 1 ? '<span class="label label-success">Xuất bản</span>' : '<span class="label label-danger">Không xuất bản</span>' !!}</td>
                        <td>
                            {!! App\Helpers\MyHtml::btnEdit('admin/product/' . $product->id . '/edit/') !!}
                            {!! App\Helpers\MyHtml::btnRemove('admin/product/' . $product->id) !!}
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

