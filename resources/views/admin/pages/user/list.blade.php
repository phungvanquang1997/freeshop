@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.users')}}
            <small>{{trans('lang.list')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="#">{{trans('lang.list')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            @include('admin.pages.user._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('lang.full_name')}}</th>
                    <th>{{trans('lang.email')}}</th>
                    <th>{{trans('lang.phone')}}</th>
                    <th>{{trans('lang.group')}}</th>
                    <th>{{trans('lang.status')}}</th>
                    <th>{{trans('lang.register')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="{{ url('admin/user/' . $user->id) }}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ \App\User::$groups[$user->group] }}</td>
                        <td class="dropdown dropdown-user-status">
                            <a class="dropdown-toggle" data-toggle="dropdown" title="{{trans('lang.click_to_change')}}">
                                {!! \MyHtml::displayUserStatus($user->status) !!}
                            </a>
                            <ul class="dropdown-menu">
                                {!! \Form::open(['method' => 'PUT', 'url' => 'admin/user/status/' . $user->id, 'class' => 'form-horizontal form-status-' . $user->id]) !!}
                                <li>
                                    <label class="label label-success">
                                    {!! \Form::radio('status', \App\User::STATUS_ACTIVE, $user->status == \App\User::STATUS_ACTIVE, ['data-id' => $user->id]) !!}
                                    {{trans('lang.activate')}}
                                    </label>
                                </li>
                                <li>
                                    <label class="label label-default">
                                    {!! \Form::radio('status', \App\User::STATUS_INACTIVE, $user->status  == \App\User::STATUS_INACTIVE, ['data-id' => $user->id]) !!}
                                    {{trans('lang.deactivate')}}
                                    </label></li>
                                {!! \Form::close() !!}
                            </ul>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>
                            <a href="{{ url('admin/user/' . $user->id ) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.view_now')}}"><i class="fa fa-eye"></i></a>
                            <!--
                            @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR || Auth::user()->group == \App\User::IS_ACCOUNTANT)
                            <a href="{{ url('admin/user/recharge/' . $user->id ) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.change_amount')}}"><i class="fa fa-money" aria-hidden="true"></i></a>
                            @endif
                            -->
                            @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR)
                            <a href="{{ url('admin/user/' . $user->id  . '/edit/') }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.edit')}}"><i class="fa fa-pencil"></i></a>
                            {!! \Form::open(['method' => 'DELETE', 'url' => 'admin/user/' . $user->id, 'class' => 'inline']) !!}
                                <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_user_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                            {!! \Form::close() !!}
                            
                            @endif
                        </td>
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

            $(document).on('change', '.dropdown-user-status input[type=radio]', function(){
                var item = $(this).attr('data-id');
                $('form.form-status-' + item).submit();
            });
        });

        function del_user_confirm()
        {
            var text = "{{trans('lang.del_user_confirm')}}";
            return confirm(text);
        }
    </script>


@stop

