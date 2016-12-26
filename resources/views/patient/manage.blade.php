@extends('layouts.layout-admin')

@section('css')

<title>EMR Admin | Manajemen Pasien</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pasien
            <small>Manajemen Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pasien</li>
            <li class="active">Manajemen Pasien</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manajemen data Pasien</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
                        <table id="full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tgl Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kota</th>
                                    <th>No. Ponsel</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($patient as $r_patient) {
                                    $id = $r_patient->id;
                                    $nik = $r_patient->nik;
                                    $name = $r_patient->name;
                                    $birth_date = $r_patient->birth_date;
                                    $gender = $r_patient->gender;
                                    $city = $r_patient->city;
                                    $mobile = $r_patient->mobile;
                                    ?>
                                    <tr>
                                        <td><?php echo $nik ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo date('d-M-Y', strtotime($birth_date)) ?></td>
                                        <td><?php echo ($gender == 'L' ? 'Laki - laki' : 'Perempuan') ?></td>
                                        <td><?php echo $city ?></td>
                                        <td><?php echo $mobile ?></td>
                                        <td>
                                            <a href="{{ url('admin/patient/detail/') }}<?php echo '/' . $id ?>" title="Lihat detail data">
                                                <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                            </a>
                                            <a href="{{ url('admin/patient/edit/') }}<?php echo '/' . $id ?>" title="Edit data">
                                                <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="{{ url('admin/patient/delete/') }}<?php echo '/' . $id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus data">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
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


@stop