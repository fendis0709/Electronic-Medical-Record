@extends((Auth::user()->status == 'Patient') ? 'layouts.layout-patient' : 'layouts.layout-admin' )


@section('css')

<title>EMR | Manajemen Resep Obat</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resep Obat
            <small>Manajemen Resep Obat</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Resep Obat</li>
            <li class="active">Manajemen Resep Obat</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manajemen data Resep Obat</h3>
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
                        <table id="full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Nama Farmasi</th>
                                    <th>Jumlah Biaya</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescription as $r_prescription)
                                <tr>
                                    <td>{{ DB::table('patient')->where('id', $r_prescription->doctor_id)->value('name') }}</td>
                                    <td>{{ DB::table('doctor')->where('id', $r_prescription->doctor_id)->value('name') }}</td>
                                    <td>Farmasi Kece</td>
                                    <td><?php echo 'Rp. ' . number_format($r_prescription->amount, 0, '', ','); ?></td>
                                    <td>{{ $r_prescription->note }}</td>
                                    <td>
                                        <a href="{{ url('patient/prescription/detail/'.$r_prescription->id) }}" title="Lihat detail">
                                            <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
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