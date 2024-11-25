<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <title>AdminLTE 3 | Starter</title>
    @include('Template.head')

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @if (session('message'))
                    <script>
                        $(document).ready(function() {
                            toastr["success"]("{{ session('message') }}");
                        });
                    </script>
                @endif
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Rekap Presensi Karyawan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Halaman Utama</a></li>
                                <li class="breadcrumb-item active">Rekap Prersensi Karyawan</li>
                                <li class="breadcrumb-item active">Edit Data</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="{{ route('ubah-rekap', ['id' => $presensi->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="tgl">Tanggal</label>
                                <input type="date" id="tgl" name="tgl" class="form-control @error('tgl') is-invalid @enderror" value="{{$presensi->tgl}}">
                                @error('tgl')
                                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jammasuk">Jam Masuk</label>
                                <input type="time" id="jammasuk" name="jammasuk" class="form-control @error('jammasuk') is-invalid @enderror" value="{{$presensi->jammasuk}}">
                                @error('jammasuk')
                                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jamkeluar">Jam Keluar</label>
                                <input type="time" id="jamkeluar" name="jamkeluar" class="form-control @error('jamkeluar') is-invalid @enderror" value="{{$presensi->jamkeluar}}">
                                @error('jamkeluar')
                                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jamkerja">Jam Kerja</label>
                                <input type="time" id="jamkerja" name="jamkerja" class="form-control @error('jamkerja') is-invalid @enderror" value="{{$presensi->jamkerja}}">
                                @error('jamkerja')
                                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('Template.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('Template.script')
</body>

</html>
