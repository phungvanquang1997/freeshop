<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=1109926709112190";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper">
	<header id="header">
	    <div class="topbar">
	        <div class="container">
	            <div class="logo"><a href="{{url('/')}}" title="">
	            	@if (isset($logo)) 
	            	<img src="{{ \App\Helpers\MyHtml::showImage($logo, 'banner') }}" alt="" />
	            	@endif
	            	</a>
	            </div>
	            <div class="right">
	                <div class="block login">
	                	@if (Auth::guest())
	                    <a class="btnlogin user_name_display" href="#" title="">Đăng nhập</a>
	                    <div class="expandlogin login">
	                        <div class="row">
	                            <div class="col-md-6 fmlogin">
	                                <p class="title">Đăng nhập bằng tài khoản Áo giá sỉ</p>
	                                <form method="post" action="{{url('/tai-khoan/dang-nhap.html')}}">
	                                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                    <div class="form-group">
	                                        <label class="field-name">Email <span class="req">*</span></label>
	                                        <input class="form-control" type="text" placeholder="Nhập email" name="p_email" value="{{ old('p_email') }}" />
	                                    </div>
	                                    <div class="form-group">
	                                        <label class="field-name">Mật khẩu <span class="req">*</span></label>
	                                        <input class="form-control" type="password" placeholder="Nhập mật khẩu" name="p_password" />
	                                    </div>
	                                    <div class="form-group form-footer">
	                                        <p>Bạn đã quên mật khẩu? <a href="{{ url('/password/email') }}" title="Quên mật khẩu">Click vào đây!</a></p>
	                                        <input class="btn btn-default" type="submit" value="Đăng nhập" />
	                                    </div>
	                                </form>
	                            </div>
	                            <div class="col-md-6 sociallogin">
	                                <p class="title">Đăng nhập bằng tài khoản Social</p>
	                                <ul>
	                                    <li><a class="btn-s-1 janrainEngage" href="{{url('facebook/auth')}}" title="">Tài khoản Facebook</a></li>
	                                    <li><a class="btn-s-2 janrainEngage" href="{{url('google/auth')}}" title="">Tài khoản Google</a></li>
	                                </ul>
	                                <p>Bạn là khách hàng mới? <a href="{{url('/tai-khoan.html')}}" title=""><strong><i>Đăng ký ngay!</i></strong></a></p>
	                            </div>
	                        </div>
	                    </div>
	                    @else
	                    	<a class="btnlogin user_name_display" href="{{url('/tai-khoan/ho-so.html')}}" title="">Chào, {{Auth::user()->name}}</a>
	                    @endif
	                </div>
	                <div class="block cart">
	                    <a class="btncart" href="{{url('/gio-hang.html')}}" title="">Giỏ hàng</a>
	                    <div class="expandcart">
	                        <p class="title">Giỏ hàng của bạn</p>
	                        <div class="shopinbag">
	                        </div>
	                    </div>
	                </div>
	                <div class="block contact">
	                    <a class="btncontact" href="#" title="">Hotline: @if (isset($hotline)) {{$hotline}} @endif<i class="fa fa-angle-down"></i></a>
	                    <div class="expandcontact">
	                        <div class="hotline">
	                            <div class="col-md-6 col-sm-6 col-xs-6">
	                                <p class="title">Hotline hỗ trợ</p>
	                                <p class="phone" style="white-space: pre-line;margin-top: -20px;">
		                                @if (isset($support_phone))
		                                	{{$support_phone}}
		                                @endif
	                                </p>
	                            </div>
	                            <div class="col-md-6 col-sm-6 col-xs-6">
	                                <p class="title">Liên hệ mua sỉ</p>
	                                <p class="phone">
	                                	@if (isset($saler_phone))
	                                		{{$saler_phone}}
	                                	@endif
	                                </p>
	                            </div>
	                        </div>
	                        <p>@if (isset($working_time)) {{$working_time}} @endif</p>
	                        <p style="color: red">Vui lòng gọi Hotline nếu ngoài giờ làm việc</p>
	                    </div>
	                </div>
	                @if (!Auth::guest())
	                <div class="block logout">
	                	<a style="padding-left: 20px;" class="" title="Thoát" href="{{url('tai-khoan/dang-xuat.html')}}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	    <div class="navbar">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-9 col-md-11 col-sm-11 col-xs-11">
	                    <div class="navbar-header">
	                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav" aria-expanded="false">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        <span class="icon-bar"></span>
	                        </button>
	                        <span>DANH MỤC SẢN PHẨM</span>
	                    </div>
						<style>
							@media (max-width: 768px) {
								.category_menu_pc {
									display: none;
								}
								#nav_pc {
									display: none;
								}
							}
							@media (min-width: 768px) {
								.category_menu_sp {
									display: none;
								}
								#nav {
									display: none!important;
								}
							}
							.bottom_sliding {
								position: absolute;
								right: -34px;
								z-index: 2;
								border: 1px solid #ccc;
								display: none;
								background: #fff
							}
							.bottom_sliding > li {
								margin: 1rem;
							}
							.bottom_sliding > li > a:hover {
								color: #ed145b
							}
							.right_sliding {
								position: absolute;
								left: 47px !important;
								top: 42px!important;
								width: 300px!important;
								z-index: 2;
								border: 1px solid #ccc;
								display: none;
								background: #fff
							}
							.right_sliding > li {
								margin: 1rem;
							}
							.right_sliding > li > a:hover {
								color: #ed145b
							}
							.category_menu_pc li a {
								color: #000;
								font-size: 14px;
								text-decoration: none;
							}
							.fa.fa-arrow-right {
								float: right;
								font-size: 10px;
								margin: 7px 0 0;
							}
							.category_menu_pc>li:hover>ul {
								display: block;
							}
						</style>
	                    <nav class="collapse navbar-collapse" id="nav">
	                   		{!! $mainMenu !!}
	                    </nav>
						<nav class="collapse navbar-collapse" id="nav_pc">
							{!! $mainMenuPC !!}
					 	</nav>
						 <!-- end menu -->
	                    <!-- /.navbar-collapse -->
	                </div>
	                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1">
						<form method="POST" action="/do-search" role="search">
							@csrf
							<div class="search">
								<a class="btnshowsearch" href="javascript:;" title="">Search</a>
								<div class="inner">
									<div class ="container">
										<input class="txtinput" id="keyword" name="keyword" type="text" value="" placeholder="Nhập từ khoá cần tìm kiếm" />
										<input class="btnsearch" type="submit" value="" />
									</div>
								</div>
							</div>
						</form>
	                </div>
	            </div>
	        </div>
	        <!--/.container -->
	    </div>
	</header>
	<!--header-->