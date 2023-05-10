<!-- Form Open -->
{!! Form::open(['method' => 'PUT', 'url' => 'admin/setting/update', 'class' => 'form-horizontal']) !!}
@if ($errors->any())
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
    	{!! Form::label('meta_title', 'Tiêu đề SEO', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::input('text', 'meta_title', isset($settings['meta_title']) ? $settings['meta_title'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! Form::label('meta_keyword', 'Từ khoá SEO', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::input('text', 'meta_keyword', isset($settings['meta_keyword']) ? $settings['meta_keyword'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! Form::label('meta_description', 'Mô tả SEO', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::textarea('meta_description', isset($settings['meta_description']) ? $settings['meta_description'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! Form::label('google_webmaster_tool', 'Mã google webmaster tool', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::input('text', 'google_webmaster_tool', isset($settings['google_webmaster_tool']) ? $settings['google_webmaster_tool'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! Form::label('google_analytic_code', 'Mã google analytic', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! Form::textarea('google_analytic_code', isset($settings['google_analytic_code']) ? $settings['google_analytic_code'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>

    {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::hidden('active', 2) !!}
 <!-- Form Close -->

{!! Form::close() !!}
@section('footer-content')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            
        });
    </script>
@stop
