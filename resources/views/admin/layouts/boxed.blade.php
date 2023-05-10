<!DOCTYPE html>
<html>

<head>
    @include('admin.includes.boxed.head')

    @yield('head')
</head>
@yield('style')
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        @include('admin.includes.boxed.header')

        @include('admin.includes.boxed.sidebar')

        <div class="content-wrapper">

            @yield('breadcrumb')

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        @yield('content')
                    </div>
                </div>
            </section>

        </div>

        @include('admin.includes.boxed.footer')

        @include('admin.includes.boxed.control-sidebar')

        <div class="control-sidebar-bg"></div>
    </div>

    <script src="{{ asset('AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/app.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>    
    <script src="{{ asset('js/jquery.growl.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/ion.sound.js') }}"></script>
    <script src="{{ asset('js/admin/notify.js') }}"></script>
    <script src="{{ asset('js/admin/admin.bigshare.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
            $('.filter-container .filter').on('change', function() {
                if ($(this).val() !== '') {
                    $(location).attr('href', '{{ URL::current() }}?'+ $(this).attr('data-type') +'=' + $(this).val());
                } else {
                    $(location).attr('href', '{{ URL::current() }}');
                }
            });

        });
    </script>
    @yield('footer-content')
    @if (Session::has('success'))
        <script type="text/javascript"> $.growl.notice({message: "{{ Session::get('success') }}"}); </script>
    @endif
    @if (Session::has('error'))
        <script type="text/javascript"> $.growl.error({message: "{{ Session::get('error') }}"}); </script>
    @endif
    @if (Session::has('warning'))
        <script type="text/javascript"> $.growl.warning({message: "{{ Session::get('warning') }}"}); </script>
    @endif

</body>
</html>
