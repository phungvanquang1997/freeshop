<!-- Customer info -->
<div class="panel panel-default panel-transportation">
    <div class="panel-body">
        @if ($order->type === \App\OrderShipping::TYPE_IMAGE || $order->type === \App\OrderShipping::TYPE_URL)
            @include('admin.pages.order_shipping._service_package', ['order' => $order])
        @elseif ($order->type === \App\OrderShipping::TYPE_SERVICE)
            @include('admin.pages.order_shipping._service_package', ['order' => $order])
        @endif
    </div>
</div>

<div class="col-sm-3"></div>
<div class="col-sm-3 no-padding">
    <button type="submit" class="btn btn-primary btn-update hidden pull-right">Cập nhật</button>
</div>
<div class="clearfix"></div>