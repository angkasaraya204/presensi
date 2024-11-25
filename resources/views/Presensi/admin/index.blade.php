<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <title>Rekap Presensi Karyawan</title>
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
                    $(document).ready(function () {
                        toastr["{{ session('type') }}"]("{{ session('message') }}");
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
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="card">
                    <div class="card-header">Lihat Data</div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="label">Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control" />
                                </div>
                                <a href="" onclick="let tglAwal = document.getElementById('tglawal').value; let tglAkhir = document.getElementById('tglakhir').value; this.href = '/filter-data-rekap' + (tglAwal ? '/' + tglAwal : '') + (tglAkhir ? '/' + tglAkhir : '');" class="btn btn-primary col-md-12 mb-2">Lihat <i class="fas fa-print"></i></a>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="label">Tanggal Akhir</label>
                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control" />
                                </div>
                                <a href="" onclick="let tglAwal = document.getElementById('tglawal').value; let tglAkhir = document.getElementById('tglakhir').value; this.href = '/ekspor-rekap-presensi' + (tglAwal ? '/' + tglAwal : '') + (tglAkhir ? '/' + tglAkhir : '');" class="btn btn-success col-md-12 mb-2">Ekspor <i class="fas fa-file-export"></i></a>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <table class="table table-hover table-bordered text-nowrap">
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Jumlah Jam Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($presensi as $item)
                                <tr>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td>{{ $item->jammasuk }}</td>
                                    <td>{{ $item->jamkeluar }}</td>
                                    <td>{{ $item->jamkerja }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="{{ route('edit-rekap', ['id' => $item->id]) }}">Edit</a>
                                                <form action="{{ route('hapus-rekap', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                        </div>
                    </div><!-- /.container-fluid -->
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
