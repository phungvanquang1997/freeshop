@extends('web.layouts.main')

@section('title')
    Tìm kiếm
@stop

@section('content')
<div id="main" style="padding: 30px;">
    <div class="container">
        <div class="heading">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#" title="">Không tìm thấy</a></li>
                </ul>
            </div>
        </div>
        <div class="alert alert-warning" role="alert">            
            <h3 style="margin: 0px;">Xin lỗi! Chúng tôi không tìm thấy trang mà bạn yêu cầu</h3>
        </div>
        <!--product-group-->
    </div>
    <!--container-->    
</div>
@stop

@section('front-footer-content')
    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>
@stop

