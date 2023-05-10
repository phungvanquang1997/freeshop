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
                <td class="view-only">{{ $order->user->name }}</td>
                
                <td class="view-only">{{ $order->user->phone }}</td>
               
                <td class="view-only">{{ $order->user->email }}</td>
                
                <td class="view-only">{{ $order->user->address }}</td>
                
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="clearfix"></div>