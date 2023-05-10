<!-- Form Open -->
{!! \Form::open(['method' => 'PUT', 'url' => 'admin/setting/update', 'class' => 'form-horizontal']) !!}
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
    	{!! \Form::label('smtp_host', 'SMTP Host', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! \Form::input('text', 'smtp_host', isset($settings['smtp_host']) ? $settings['smtp_host'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('smtp_port', 'SMTP Port', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! \Form::input('text', 'smtp_port', isset($settings['smtp_port']) ? $settings['smtp_port'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('smtp_user', 'SMTP Username', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! \Form::input('text', 'smtp_user', isset($settings['smtp_user']) ? $settings['smtp_user'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 text-right">
        {!! \Form::label('smtp_pass', 'SMTP Password', false) !!}
        </div>
        <div class="col-sm-7">
            <div class="form-group">
                {!! \Form::input('text', 'smtp_pass', isset($settings['smtp_pass']) ? $settings['smtp_pass'] : null, ['class' => 'form-control']) !!}                
            </div>
        </div>
    </div>        
    {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
</div>
{!! \Form::hidden('active', 2) !!}
 <!-- Form Close -->

{!! \Form::close() !!}
@section('footer-content')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            
        });
    </script>
@stop
