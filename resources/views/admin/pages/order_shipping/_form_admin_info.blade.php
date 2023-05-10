<!-- Customer info -->
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table no-margin">
            <tr>
                <th>{{trans('lang.full_name')}}</th>
                <th>{{trans('lang.phone')}}</th>
                <th>{{trans('lang.email')}}</th>
                <th>{{trans('lang.address')}}</th>
            </tr>
            <tbody>
            <tr>
                <td class="view-only">{{ $order->admin ? $order->admin->name : null }}</td>
                
                <td class="view-only">{{ $order->admin ? $order->admin->phone : null  }}</td>
               
                <td class="view-only">{{ $order->admin ? $order->admin->email : null  }}</td>
                
                <td class="view-only">{{ $order->admin ? $order->admin->address : null  }}</td>
                
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="clearfix"></div>