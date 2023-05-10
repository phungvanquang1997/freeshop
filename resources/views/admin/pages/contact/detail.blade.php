@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Liên hệ của: {{ $contact->name }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/contact') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{ $contact->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-2 pull-right text-right">
                    <a class="btn btn-default" href="{{ url('admin/contact') }}">Quay lại</a>
                </div>
            </div>
            <div class="form-horizontal">
                
                {!! App\Helpers\MyHtml::show('Tên người gửi', $contact->name) !!}
                {!! App\Helpers\MyHtml::show('Email', $contact->email) !!}
                {!! App\Helpers\MyHtml::show('Số điện thoại', $contact->phone) !!}
                {!! App\Helpers\MyHtml::show('Loại', App\Contact::$types[$contact->type]) !!}
                {!! App\Helpers\MyHtml::show('Chức vụ', $contact->position) !!}
                {!! App\Helpers\MyHtml::show('Công ty', $contact->company) !!}
                {!! App\Helpers\MyHtml::show('Website', $contact->website) !!}
                {!! App\Helpers\MyHtml::show('Địa chỉ', $contact->address) !!}
                {!! App\Helpers\MyHtml::show('Nội dung', $contact->content) !!}

                {!! App\Helpers\MyHtml::show('Ngày gửi', date('d/m/Y', strtotime($contact->created_at))) !!}
            </div>
        </div>
    </div>
@stop

@section('footer-content')

@stop

