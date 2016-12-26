@extends('layouts.layout-admin')

@section('css')

<title>EMR Admin | Manajemen Farmasi</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Farmasi
            <small>Manajemen Farmasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pasien</li>
            <li class="active">Manajemen Farmasi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manajemen data Farmasi</h3>
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
                            <button class="btn btn-info btn-md" style="margin: 0 25px 25px 25px">Tambah Farmasi</button>
                        </div>
                        <table id="full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kota</th>
                                    <th>No. Ponsel</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pharmacy as $r_pharmacy)
                                <tr>
                                    <td>{{ $r_pharmacy->name }}</td>
                                    <td>{{ $r_pharmacy->city }}</td>
                                    <td>{{ $r_pharmacy->mobile }}</td>
                                    <td>{{ $r_pharmacy->telephone }}</td>
                                    <td>
                                        <a href="{{ url('admin/pharmacy/detail/'.$r_pharmacy->id) }}">
                                            <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                        </a>
                                        <a href="{{ url('admin/pharmacy/edit/'.$r_pharmacy->id) }}">
                                            <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ url('admin/pharmacy/delete/'.$r_pharmacy->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus farmasi ini?')">
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