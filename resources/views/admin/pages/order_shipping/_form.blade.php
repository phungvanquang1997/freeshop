<!-- Products -->
@if ($order->type === \App\OrderShipping::TYPE_IMAGE || $order->type === \App\OrderShipping::TYPE_URL)
    @include('admin.pages.order_shipping._item_form', ['order' => $order])
@else
    @include('admin.pages.order_shipping._service_form', ['order' => $order])
@endif




