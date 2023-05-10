@extends('web.layouts.main')
@section('title')
Liên hệ với chúng tôi
@stop
@section('body')
{{ 'category-page' }}
@stop
@section('content')
<div id="main" style="padding-top: 30px;">
    <div class="container">
        <div class="col-lg-3 col-md-4">
            <div class="about-menu">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span>Hợp tác kinh doanh với Áo Giá Sỉ </span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @if (isset($pages) && count($pages) > 0)
                        @foreach ($pages as $item)
                        <li><a href="{{ url ($item->slug . '.htm') }}">{{ $item->title }}</a></li>
                        @endforeach
                        @endif
                        <li><a href="/lien-he.html">Liên hệ với chúng tôi</a></li>
                        <li><a href="/hop-tac-kinh-doanh.html">Hợp tác kinh doanh với Áo Giá Sỉ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="editor txtabout">
                <h1 class="page-title"><span><h3>Hợp tác kinh doanh với Áo Giá Sỉ</h3></span></h1>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="content-other docs">
                    <div class="contact-intro-text">
                        {!! $partner_intro_text !!}
                    </div>                
                   <div class="form">
                        <form name="frm_lienhe" id="frm_lienhe" action="/contact/create-partner" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group ">
                                <label class="field-name">Họ và tên: <span class="req">*</span></label>
                                <div class="input-container ">
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name') !== null ? old('name') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-email">Email: <span class="req">*</span></label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="email" id="email" value="{{old('email') !== null ? old('email') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-phone">Điện thoại di động: <span class="req">*</span></label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone') !== null ? old('phone') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-position">Chức vụ: </label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="position" id="position" value="{{old('position') !== null ? old('position') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-company">Tên doanh nghiệp: <span class="req">*</span></label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="company" id="company" value="{{old('company') !== null ? old('company') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-website">Website: </label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="website" id="website" value="{{old('website') !== null ? old('website') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="field-address">Địa chỉ: <span class="req">*</span></label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="address" id="address" value="{{old('address') !== null ? old('address') : ''}}"/>
                                </div>
                            </div>
                            <div class="form-group "">
                                <label class="field-content">Nội dung: <span class="req">*</span></label>
                                <div class="input-container"><textarea name="content" class="form-control" rows="5">{{old('content') !== null ? old('content') : ''}}</textarea></div>
                            </div>
                            <div class="mt20">
                                <div class="lable left">Mã xác nhận</div>
                                <div class="input_checkout left">
                                    {!! $captcha !!}
                                </div>
                                <div class="clearAll"></div>
                            </div>
                            <div class="form-group ">
                                <label class="field-name">Nhập mã xác nhận: <span class="req">*</span></label>
                                <div class="input-container">
                                    <input type="text" class="form-control" name="captcha" id="captcha" />
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block" value="GỬI" type="submit">GỬI</button>
                            </div>
                        </form>
                    </div>           
                </div>

            </div>
        </div>
        <div class="bottom-line"></div></div>
    </div>
    @stop