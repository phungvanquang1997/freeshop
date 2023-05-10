@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Liên hệ
            <small>danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="{{ url('admin/contact') }}">Liên hệ</a></li>
            <li class="active"><a href="#">Danh sách</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            @include('admin.pages.contact._filter')
            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Loại</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Nội dung</th>
                    <th>Ngày gửi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    
                    <tr>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->id }}</a></td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">
                            @if ($contact->type == 1 || $contact->type == 0) 
                                {{'Liên hệ'}} 
                            @else 
                                {{'Hợp tác'}} 
                            @endif
                            </a>
                        </td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->name }}</a></td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->email }}</a></td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->phone }}</a></td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->content }}</a></td>
                        <td><a href="{{url('/admin/contact/' . $contact->id)}}">{{ $contact->created_at }}</a></td>
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

