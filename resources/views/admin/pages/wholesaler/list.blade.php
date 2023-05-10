@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Nhà cung cấp
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

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>Level</th>
                    <th width="15%"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($wholesalers as $wholesale)
                        <tr>
                            <td>{{ $wholesale->id }}</td>
                            <td>{{ $wholesale->name }}</td>
                            <td>{{ $wholesale->type == 1 ? 'Nhà sản xuất' : 'Đại lý' }}</td>
                            <td>{!! \App\Helpers\MyHtml::showWholesalerLevel($wholesale->level_type, $wholesale->level) !!}</td>
                            <td>
                                {!! App\Helpers\MyHtml::btnEdit('admin/wholesaler/' . $wholesale->id . '/edit/') !!}
                                {!! App\Helpers\MyHtml::btnRemove('admin/wholesaler/' . $wholesale->id) !!}
                            </td>
                        </tr>
                    @empty
                    @endforelse
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
                "order": [1,2]
            });

            $('.select-type').on('change', function () {
                $(location).attr('href', '{{ URL::current() }}?type=' + $(this).val());
            });
        });
    </script>

@stop

