<div class="col-lg-3 col-md-4">
    <div class="about-menu">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span>Về chúng tôi </span>
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach ($postList as $item)
                    <li @if ($item->id == $post->id) class="active" @endif><a href="{{url('/noi-dung/chinh-sach/' . $item->slug)}}">{{$item->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>