<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page_title or "Admin Dashboard" }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css') }}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.includes.default.header')
    @include('admin.includes.default.sidebar')
    <div class="content-wrapper">
        @yield('page-header')
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('admin.includes.default.footer')
    @include('admin.includes.default.control-sidebar')
</div>
<script src="{{ asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
</body>
</html>
