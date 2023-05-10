<!-- Form Open -->
{!! \Form::open(['method' => 'PUT', 'url' => 'admin/setting/update', 'files' => true, 'class' => 'form-horizontal']) !!}
@if ($errors->any())
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h4><i class="icon fa fa-ban"></i> {{trans('lang.notify')}}!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endif
<div class="row">

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('site_logo', 'Logo', false) !!}
        </div>
        @if (isset($settings) && !empty($settings['site_logo'])) 
            <div class="col-sm-5">
            	<img src="{{ MyHtml::showThumb($settings['site_logo'], 'banner', 'logo') }}">            
            </div>
        @endif
        <div class="col-md-3">
            {!! MyHtml::file('site_logo', ['class' => '']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('sub_logo', 'Logo 2', false) !!}
        </div>
        @if (isset($settings) && !empty($settings['sub_logo'])) 
            <div class="col-sm-5">
            	<img src="{{ MyHtml::showThumb($settings['sub_logo'], 'banner', 'logo') }}">            
            </div>
        @endif
        <div class="col-md-3">{!! MyHtml::file('sub_logo', ['class' => '']) !!}</div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('site_name', 'Tên website', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'site_name', isset($settings['site_name']) ? $settings['site_name'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('company_name', 'Tên công ty', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'company_name', isset($settings['company_name']) ? $settings['company_name'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('company_address', 'Địa chỉ', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('company_address', isset($settings['company_address']) ? $settings['company_address'] : null, ['class' => 'tinymce form-control', 'rows' => '5']) !!}
        </div>
    </div>
          
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('company_email', 'Email', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'company_email', isset($settings['company_email']) ? $settings['company_email'] : null, ['class' => 'form-control']) !!}
        </div>
    </div> 

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('company_phone', 'Số điện thoại', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'company_phone', isset($settings['company_phone']) ? $settings['company_phone'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('hotline', 'Hotline', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'hotline', isset($settings['hotline']) ? $settings['hotline'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>     
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('support_phone', 'Hỗ trợ', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('support_phone', isset($settings['support_phone']) ? $settings['support_phone'] : null, ['class' => 'form-control', 'rows' => '3']) !!}
        </div>
    </div>          
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('saler_phone', 'Bán hàng', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('saler_phone', isset($settings['saler_phone']) ? $settings['saler_phone'] : null, ['class' => 'form-control', 'rows' => '3']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('working_time', 'Thời gian làm việc', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'working_time', isset($settings['working_time']) ? $settings['working_time'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('facebook_link', 'Facebook', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'facebook_link', isset($settings['facebook_link']) ? $settings['facebook_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('google_plus_link', 'Google plus', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'google_plus_link', isset($settings['google_plus_link']) ? $settings['google_plus_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('instagram_link', 'Instagram', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'instagram_link', isset($settings['instagram_link']) ? $settings['instagram_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('zalo_link', 'Zalo', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'zalo_link', isset($settings['zalo_link']) ? $settings['zalo_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('ship_text', 'Thông báo giá ship', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'ship_text', isset($settings['ship_text']) ? $settings['ship_text'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('footer_menu1_title', '[Footer Menu 1 title]', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'footer_menu1_title', isset($settings['footer_menu1_title']) ? $settings['footer_menu1_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('dcma_link', 'Link DCMA', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'dcma_link', isset($settings['dcma_link']) ? $settings['dcma_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>

        <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('gov_link', 'Link đăng ký bộ công thương', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'gov_link', isset($settings['gov_link']) ? $settings['gov_link'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('footer_menu2_title', '[Footer Menu 2 title]', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'footer_menu2_title', isset($settings['footer_menu2_title']) ? $settings['footer_menu2_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div> 


    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('home_seo_title', 'Tiêu đề nội dung SEO Trang chủ', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'home_seo_title', isset($settings['home_seo_title']) ? $settings['home_seo_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>        
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('home_seo_content', 'Nội dung SEO Trang chủ', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('home_seo_content', isset($settings['home_seo_content']) ? $settings['home_seo_content'] : null, ['class' => 'tinymce form-control']) !!}       
        </div>
    </div> 

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('product_related_box_title', 'Tiêu đề sản phẩm gợi ý', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'product_related_box_title', isset($settings['product_related_box_title']) ? $settings['product_related_box_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div> 

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('contact_intro_text', 'Giới thiệu liên hệ', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('contact_intro_text', isset($settings['contact_intro_text']) ? $settings['contact_intro_text'] : null, ['class' => 'tinymce form-control', 'rows' => '5']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('partner_intro_text', 'Giới thiệu hợp tác', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('partner_intro_text', isset($settings['partner_intro_text']) ? $settings['partner_intro_text'] : null, ['class' => 'tinymce form-control', 'rows' => '5']) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_1_title', 'Tên show room 01', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'show_room_1_title', isset($settings['show_room_1_title']) ? $settings['show_room_1_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_1_image', 'Hình ảnh show room 01', false) !!}
        </div>
        @if (isset($settings) && !empty($settings['show_room_1_image'])) 
            <div class="col-sm-5">
                <img src="{{ MyHtml::showThumb($settings['show_room_1_image'], 'banner', 'logo') }}">            
            </div>
        @endif
        <div class="col-md-3">
            {!! MyHtml::file('show_room_1_image', ['class' => '']) !!}
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_1_address', 'Địa chỉ show room 01', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('show_room_1_address', isset($settings['show_room_1_address']) ? $settings['show_room_1_address'] : null, ['class' => 'form-control', 'rows' => '5']) !!}
        </div>
    </div>     
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_1_map_code', 'Mã nhúng bản đồ show room 01', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('show_room_1_map_code', isset($settings['show_room_1_map_code']) ? $settings['show_room_1_map_code'] : null, ['class' => 'form-control', 'rows' => '5']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_2_title', 'Tên show room 02', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::input('text', 'show_room_2_title', isset($settings['show_room_2_title']) ? $settings['show_room_2_title'] : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_2_image', 'Hình ảnh show room 02', false) !!}
        </div>
        @if (isset($settings) && !empty($settings['show_room_2_image'])) 
            <div class="col-sm-5">
                <img src="{{ MyHtml::showThumb($settings['show_room_2_image'], 'banner', 'logo') }}">
            </div>
        @endif
        <div class="col-md-3">
            {!! MyHtml::file('show_room_2_image', ['class' => '']) !!}
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_2_address', 'Địa chỉ show room 02', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('show_room_2_address', isset($settings['show_room_2_address']) ? $settings['show_room_2_address'] : null, ['class' => 'form-control', 'rows' => '5']) !!}
        </div>
    </div>     
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('show_room_2_map_code', 'Mã nhúng bản đồ show room 02', false) !!}
        </div>
        <div class="col-sm-7">
        {!! \Form::textarea('show_room_2_map_code', isset($settings['show_room_2_map_code']) ? $settings['show_room_2_map_code'] : null, ['class' => 'form-control', 'rows' => '5']) !!}
        </div>
    </div>        

    {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
</div>
{!! \Form::hidden('active', 1) !!}
 <!-- Form Close -->
{!! \Form::close() !!}
@section('footer-content')
    @parent

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ url('') }}/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="{{ url('') }}/tinymce/tinymce_editor.js"></script>
    <script type="text/javascript">
    editor_config.selector = "textarea.tinymce";
    editor_config.path_absolute = "{{ url('') }}/";
    tinymce.init(editor_config);
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var elem_1 = document.querySelector('.js-switch_1');
            var switchery_1 = new Switchery(elem_1, { color: '#83C322' });
            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#83C322' });
            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#83C322' });
            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#83C322' });
        });
    </script>
@stop