@extends('layouts.layout-admin')

@section('css')

<title>EMR Admin | Manajemen Dokter</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dokter
            <small>Manajemen data dokter</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Dokter</li>
            <li class="active">Manajemen Dokter</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manajemen data Dokter</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <?php if (NULL !== (Session::get('message'))) {
                            ?>
                            <div class="col-md-push-3 col-md-6">
                                <div class="box box-success box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Pesan</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        {{ Session::get('message') }}
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="pull-right hidden">
                            <button class="btn btn-info btn-md" style="margin: 0 25px 25px 25px">Tambah dokter</button>
                        </div>
                        <table id="full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Spesialisasi</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Kota</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctor as $r_doctor)
                                <tr>
                                    <td>{{ $r_doctor->name }}</td>
                                    <td>{{ $r_doctor->specialization }}</td>
                                    <td>{{ ($r_doctor->gender == 'L' ? 'Laki - laki' : 'Perempuan') }}</td>
                                    <td>{{ date('d-M-Y', strtotime($r_doctor->birth_date)) }}</td>
                                    <td>{{ $r_doctor->city }}</td>
                                    <td>{{ $r_doctor->telephone }}</td>
                                    <td>
                                        <a href="{{ url('admin/doctor/detail/'.$r_doctor->id) }}" title="Lihat detail">
                                            <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                        </a>
                                        <a href="{{ url('admin/doctor/edit/'.$r_doctor->id) }}" title="Edit data">
                                            <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ url('admin/doctor/delete/'.$r_doctor->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@stop

@section('js')


<!-- DataTables -->
<!--<script src="{{ URL::asset('assets/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>-->
<!--<script src="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>-->

<!-- page script -->
<script>
    $(function () {
        $('#full').DataTable();
        $('#custom').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

@stop