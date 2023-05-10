@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.menus')}}: {{ $menu->name }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/menu') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{ $menu->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-2 pull-right text-right">
                    @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR)
                    <a class="btn btn-primary" href="{{ url('admin/menu/item-create/' . $menu->id) }}">{{trans('lang.add_new')}}</a>
                    @endif
                </div>
            </div>
            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">ID</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.name')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.status')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1">{{trans('lang.num_oder')}}</th>
                        <th tabindex="0" rowspan="1" colspan="1" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$menuItems->isEmpty())
                        @foreach ($menuItems as $item)
                    
                        <tr>                          
                            <td class="sorting_1">{{ $item->id}}</td>
                            <td>{{ $item->name}}</td>
                            <td class="center">
                                @if($item->status == \App\Menu::STATUS_ACTIVE)
                                    <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                @else
                                    <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->ordering }}</td>
                            <td>
                                <a href="{{ url('admin/menu/item-edit/' . $item->id) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.update')}}"><i class="fa fa-pencil"></i></a>
                                <form method="POST" action="admin/menu/item-delete/{{ $item->id }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_menu_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        @if (\App\MenuItem::getChildren($item->id) != null)
                            @foreach (\App\MenuItem::getChildren($item->id) as $child)
                                <tr>                          
                                    <td class="sorting_1">{{ $child->id}}</td>
                                    <td>|-- {{ $child->name}}</td>
                                    <td class="center">
                                        @if($child->status == \App\Menu::STATUS_ACTIVE)
                                            <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                        @else
                                            <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $child->ordering }}</td>
                                    <td>
                                        <a href="{{ url('admin/menu/item-edit/' . $child->id) }}"
                                       class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.update')}}"><i class="fa fa-pencil"></i></a>
                                        <form method="POST" action="admin/menu/item-delete/{{ $child->id }}" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_menu_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @if (\App\MenuItem::getChildren($child->id) != null)
                                    @foreach (\App\MenuItem::getChildren($child->id) as $son)
                                        <tr>                          
                                            <td class="sorting_1">{{ $son->id}}</td>
                                            <td>|--|-- {{ $son->name}}</td>
                                            <td class="center">
                                                @if($son->status == \App\Menu::STATUS_ACTIVE)
                                                    <i class="fa fa-check-circle text-success" title="{{trans('lang.activate')}}"></i>
                                                @else
                                                    <i class="fa fa-check-circle text-danger" title="{{trans('lang.deactivate')}}"></i>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $son->ordering }}</td>
                                            <td>
                                                <a href="{{ url('admin/menu/item-edit/' . $son->id) }}"
                                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.update')}}"><i class="fa fa-pencil"></i></a>
                                                <form method="POST" action="admin/menu/item-delete/{{ $son->id }}" class="inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_menu_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                        Không có menu</td>
                    </tr>                        
                    @endif                   
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
                "order": [1,2]
            });

            $('.select-type').on('change', function () {
                $(location).attr('href', '{{ URL::current() }}?type=' + $(this).val());
            });
        });
        function del_menu_confirm()
        {
            var text = "{{trans('lang.del_menu_confirm')}}";
            return confirm(text);
        }
    </script>

@stop

