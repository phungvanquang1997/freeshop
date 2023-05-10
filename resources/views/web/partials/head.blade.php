<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="vi" />
<meta name="Language" content="vietnamese" />
<meta name="title" content="@if (isset($meta_title_detail) && $meta_title_detail != '') {!!strip_tags($meta_title_detail)!!} @elseif (isset($meta_title)) {!!strip_tags($meta_title)!!} @endif">
<meta name="description" content="@if (isset($meta_description_detail) && $meta_description_detail != '') {!!strip_tags($meta_description_detail)!!} @elseif (isset($meta_description)) {!!strip_tags($meta_description)!!} @endif">
<meta name="keywords" content="@if (isset($meta_keyword_detail) && $meta_keyword_detail != '') {!!strip_tags($meta_keyword_detail)!!} @elseif (isset($meta_keyword)) {!!strip_tags($meta_keyword)!!} @endif" >
<meta name="robots" content="INDEX,FOLLOW,NOODP" />
<meta name = "viewport" content = "initial-scale=1.0, width=device-width" />
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>@if (isset($meta_title_detail) && $meta_title_detail != '') {!!strip_tags($meta_title_detail)!!} @elseif (isset($meta_title)) {!!strip_tags($meta_title)!!} @endif</title>
<link rel="stylesheet" type="text/css" href=" https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.min.css') }}" media="screen" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel='canonical' href='{{ URL::current() }}' />
<link rel="icon" href="{{ URL::to('/favicon.ico') }}" type="image/x-icon" />
<link rel="shortcut icon" href="{{ URL::to('/favicon.ico') }}" type="image/x-icon" />
<meta content="289139241165786" property="fb:app_id">
<meta property='og:locale' content='vi_VN'/>
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:type" content="website">
<meta property="og:image" content="@if (isset($meta_image) && $meta_image != '') {{$meta_image}} @endif">
<meta property="og:site_name" content="thoitrangred.com">
<meta property="og:title" content="@if (isset($meta_title_detail) && $meta_title_detail != '') {!!strip_tags($meta_title_detail)!!} @elseif (isset($meta_title)) {!!strip_tags($meta_title)!!} @endif">
<meta property="og:description" content="@if (isset($meta_description_detail) && $meta_description_detail != '') {!!strip_tags($meta_description_detail)!!} @elseif (isset($meta_description)) {!!strip_tags($meta_description)!!} @endif">
<link href="@if (isset($google_plus_link)) {{$google_plus_link}} @endif" rel="publisher">
<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
<meta name="DC.title" content="@if (isset($meta_title_detail) && $meta_title_detail != '') {{$meta_title_detail}} @elseif (isset($meta_title)) {{$meta_title}} @endif" />
<meta name="DC.identifier" content="{{ URL::to('/') }}" />
<meta name="DC.description" content="@if (isset($meta_description_detail) && $meta_description_detail != '') {!!strip_tags($meta_description_detail)!!} @elseif (isset($meta_description)) {!!strip_tags($meta_description)!!} @endif" />
<meta name="DC.subject" content="@if (isset($meta_title_detail) && $meta_title_detail != '') {!!strip_tags($meta_title_detail)!!} @elseif (isset($meta_title)) {!!strip_tags($meta_title)!!} @endif" />
<meta name="DC.language" content="vi" />
<link rel="stylesheet" type="text/css" href="{{ asset('AdminLTE/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.growl.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/account.signup.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/product.detail.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript"  src="{{ asset('js/main.min.js') }}" defer></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    var base_url = '{{ url('') }}';
    var siteUrl = '{{ url('') }}';
    var loadZopim = 1;
    var total_cart = [];
</script>