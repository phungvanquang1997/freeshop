<div class="col-lg-3 visible-lg-block">
    <div class="hot-news sidebar">
        <h2 class="title">Xem nhiều</h2>
        <div class="list-hot-news clearfix">

            @foreach ($dataPostMostView as $dataPostMostViewDetail)
                <div class="news-item">
                    <div class="thumb">
                        <a href="{{ url('tin-tuc/' . $dataPostMostViewDetail->id . '-' .$dataPostMostViewDetail->slug . '.htm') }}" title="{{ $dataPostMostViewDetail->title }}">
                            <img src="{{ \App\Helpers\MyHtml::showThumb($dataPostMostViewDetail->image, 'blog', 'medium') }}"  alt="{{ $dataPostMostViewDetail->title }}" />
                            <span class="overlay"></span>
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="title">
                            <a href="{{ url('tin-tuc/' . $dataPostMostViewDetail->id . '-' .$dataPostMostViewDetail->slug . '.htm') }}" title="{{ $dataPostMostViewDetail->title }}">{{ $dataPostMostViewDetail->title }}</a>
                        </h3>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>