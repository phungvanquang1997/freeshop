@if ( !$hotProducts->isEmpty() && $hotProducts->count() >= 2 )
    <div class="col-left-slide left-module">
        <ul class="owl-carousel owl-style2" data-loop="true" data-nav="false" data-margin="30"
            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1" data-autoplay="true">
            @foreach ($hotProducts as $product)
                <li>
                    <a href="{{ url('p/' . $product->slug) }}">
                        <img src="{{ \App\Helpers\MyHtml::showImage($product->mainImage()->image, 'product') }}" alt="{{ $product->name }}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif