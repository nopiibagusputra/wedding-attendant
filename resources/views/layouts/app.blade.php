<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="{{ url('/main.d810cf0ae7f39f28f336.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    @stack('css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            @include('layouts.navbar')
        </div>
        <div class="app-main">
            @include('layouts.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
            {{-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> --}}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>
    <script type="text/javascript" src="{{ url('/assets/scripts/main.d810cf0ae7f39f28f336.js') }}"></script>
    <script>
        $(document).ready(function () {
               $('#tabel_list').DataTable({
                   paging: true,
                   ordering: true,
                   info: true,
                   language: {
                   "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                   "sProcessing": "Sedang memproses...",
                   "sLengthMenu": "Tampilkan _MENU_ data",
                   "sZeroRecords": "Tidak ditemukan data yang sesuai",
                   "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                   "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                   "sInfoFiltered": "(disaring dari _MAX_ total data)",
                   "sInfoPostFix": "",
                   "sSearch": "Cari:",
                   "sUrl": "",
                   "oPaginate": {
                   "sFirst": "Pertama",
                   "sPrevious": "Sebelumnya",
                   "sNext": "Selanjutnya",
                   "sLast": "Terakhir"
                   }
                 }
               });
           });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    @stack('scripts')
    @stack('modal')
    @include('sweetalert::alert')
</body>

</html>
