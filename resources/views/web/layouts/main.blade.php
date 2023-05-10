<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">

<head>
    @include('web.partials.head')

    @yield('head')
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TTLXZ7J');</script>
<!-- End Google Tag Manager -->
</head>

<body class="@yield('body')">

    @include('web.partials.header')

    @yield('content')
		
    @include('web.partials.footer')
    @yield('front-footer-content')
	@yield('google_remarketing')
  
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTLXZ7J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>
</html>