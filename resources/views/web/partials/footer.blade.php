<footer id="footer">
    <div class="inner clearfix">
        <div class="container">
            <div class="row flip-container">
                <div class="flip-card">
                    <div class="front">
                        <a target="_blank" href="">
                            @if (isset($show_room_1_image))
                            <img src="{{ MyHtml::showImage($show_room_1_image, 'banner', 'logo') }}">
                            @endif
                            <div class="branch-info">
                                <p class="branch-name">@if (isset($show_room_1_title)) {{$show_room_1_title}} @endif</p>
                                <p class="branch-address">@if (isset($show_room_1_address)) {{$show_room_1_address}} @endif</p>
                            </div>
                        </a>
                    </div>
                    <div class="back">
                    @if (isset($show_room_1_map_code))
                        {!!$show_room_1_map_code!!}
                    @endif
                    </div>
                </div>
                <div class="flip-card">
                    <div class="front">
                        <a target="_blank" href="">
                            @if (isset($show_room_2_image))
                            <img src="{{ MyHtml::showImage($show_room_2_image, 'banner', 'logo') }}">
                            @endif
                            <div class="branch-info">
                                <p class="branch-name">@if (isset($show_room_2_title)) {{$show_room_2_title}} @endif</p>
                                <p class="branch-address">@if (isset($show_room_2_address)) {{$show_room_2_address}} @endif</p>
                            </div>
                        </a>
                    </div>
                    <div class="back">
                        @if (isset($show_room_2_map_code))
                            {!!$show_room_2_map_code!!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="bottom row">
                <div class="block col-lg-3 col-md-4 col-sm-12">
                    <div class="logo"><a href="{{url('/')}}" title="">
                        @if (isset($sub_logo))
                        <img src="{{ \App\Helpers\MyHtml::showImage($sub_logo, 'banner') }}" alt="" />
                        @endif
                    </a></div>
                    <div class="copyright">
                        <div style="white-space: normal;margin-top: -20px">
                            @if (isset($company_address))
                                {!!$company_address!!}
                            @endif
                        </div>
                    </div>
                    @if (isset($gov_link))
                    <div class="certify"><a href="{{$gov_link}}"><img width="100" src="{{ asset('images/gov-icon.png') }}" title="" alt="" /></a></div>
                    @endif
                    @if (isset($dcma_link))
                    <div class="certify"><a href="{{$dcma_link}}" title="DMCA.com Protection Status" class="dmca-badge"> <img src="{{ asset('images/dmca.png') }}" alt="DMCA.com Protection Status"></a></div>
                    @endif
                </div>
                <div class="block col-lg-6 col-md-2 col-sm-4">
                    <nav class="nav">
                        <ul>
                            <li>
                                <a title="">
                                @if (isset($footer_menu1_title))
                                    {{$footer_menu1_title}}
                                @endif                                    
                                </a>
                                {!! $footer_menu_left !!}
                            </li>
                            <li>
                                <a title="">
                                @if (isset($footer_menu2_title))
                                    {{$footer_menu2_title}}
                                @endif                                    
                                </a>
                                {!! $footer_menu_right !!}
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="block col-lg-3 col-md-3 col-sm-4 col-xs-5">
                    <p class="title">Hotline hỗ trợ</p>
                    <p class="phone" style="white-space: pre-line;margin-top: -20px">
                        @if (isset($support_phone))
                            {{$support_phone}}
                        @endif
                    </p>
                    <p>@if (isset($working_time)) {{$working_time}} @endif <br/> <span style="color: red">Vui lòng gọi Hotline nếu đến sau giờ làm việc</span></p>
                </div>
                <div class="block col-lg-3 col-md-3 col-sm-4 col-xs-7">
                    <div class="followme">
                        <p class="title">Kết nối</p>
                        <ul class="social">
                            <li><a class="icon-s-1" href="@if (isset($facebook_link)) {{$facebook_link}} @endif" title="">Facebook</a></li>
                            <li><a class="icon-s-2" href="@if (isset($zalo_link)) {{$zalo_link}} @endif" title="">Zalo</a></li>
                            <li><a class="icon-s-3" href="@if (isset($google_plus_link)) {{$google_plus_link}} @endif" title="">Google</a></li>
                            <li><a class="icon-s-4" href="@if (isset($instagram_link)) {{$instagram_link}} @endif" title="">Instaram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mbottom">
                <div class="logo"><a href="{{url('/')}}" title="">
                    @if (isset($sub_logo))
                    <img src="{{ \App\Helpers\MyHtml::showImage($sub_logo, 'banner') }}" alt="" />
                    @endif
                </a></div>
                <div class="copyright">
                    <div style="white-space: normal;margin-top: -20px">
                        @if (isset($company_address))
                            {!!$company_address!!}
                        @endif
                    </div>
                </div>
                @if (isset($gov_link))
                <div class="certify"><a href="{{$gov_link}}"><img width="100" src="{{ asset('images/gov-icon.png') }}" title="" alt=""/></a></div>
                @endif
                @if (isset($dcma_link))
                <div class="certify"><a href="{{$dcma_link}}" title="DMCA.com Protection Status" class="dmca-badge"> <img src="{{ asset('images/dmca.png') }}" alt="DMCA.com Protection Status"></a></div>
                @endif
            </div>
        </div>
    </div>
</footer>
<!--footer-->
<a href="javascript:;" class="cd-top"></a>
<div class="clear"> </div>
</div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.growl.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/my-cart.js') }}"></script>
<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js">

<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $(document).ready(function() {
        localStorage.setItem("add-cart-success", "{{ trans('lang.Product was add to cart successfully!')}}");
        localStorage.setItem("add-cart-error", "{{ trans('lang.Cannot add product to cart!')}}");
        localStorage.setItem("update-cart-success", "{{ trans('lang.Cart was update successfully!')}}");
        localStorage.setItem("remove-cart-success", "{{ trans('lang.Product was remove successfully!')}}");
        $('.btn-box-close').click(function(){
            $('.fchat').hide(); 
        });
    });
</script>
@include('web.partials.session_flash')