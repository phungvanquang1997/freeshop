<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
    <div class="item">
        @if (strlen($product->mainImage()->image))
        <div class="thumb">
            <a href="{{ url($product->id . '-' . $product->slug) }}" title="{!! $product->name !!}">
            <img src="{{ \App\Helpers\MyHtml::showImage($product->mainImage()->image, 'product') }}" alt="{!! $product->name !!}" title="{!! $product->name !!}">
            <span class="overlay"></span>
            </a>
        </div>
        @endif
        <div class="caption">
            <h3 class="title"><a href="{{ url($product->id . '-' . $product->slug) }}" title="{{ $product->name }}">{{ $product->name }}</a></h3>
            <p class="meta">
            <span class="price">
            @if ($product->price > 0)
            {{ number_format($product->price) }}đ
            @else 
                Liên hệ
            @endif
            </span>             
            @if ($product->is_hot == 1)
            <i class="i-hot"></i>
            @endif
            <span class="count">{{ number_format($product->total_sales) }}</span></p>
        </div>
    </div>
</div>