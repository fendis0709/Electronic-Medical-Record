@extends((Auth::user()->status == 'Admin' ? 'layouts.layout-admin' : (Auth::user()->status == 'Doctor' ? 'layouts.layout-doctor' : ( Auth::user()->status == 'Lab' ? 'layouts.layout-lab' : (Auth::user()->status == 'Pharmacy' ? 'layouts.layout-pharmacy' : 'layouts.layout-patient')))))

@section('css')

<title>EMR Admin | Manajemen Resep Farmasi</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resep Farmasi
            <small>Hasil Pencarian Resep Farmasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Resep Farmasi</li>
            <li class="active">Cari Resep Farmasi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hasil Pencarian Resep Farmasi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        if ($form == 'search') {
                            ?>
                            @if(Auth::user()->status == 'Patient')
                            <form class="form-horizontal" method="POST" action="{{ url('pharmacy/prescription/search') }}">
                            @elseif(Auth::user()->status == 'Pharmacy')
                                <form class="form-horizontal" method="POST" action="{{ url('patient/prescription/search') }}">
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Tanggal Resep Farmasi</label>

                                        <div class="col-sm-6">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="date" type="text" class="form-control pull-right" id="datepicker" value="{{ date('m/d/Y', strtotime($date)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a href="search-result">
                                                <button type="submit" class="btn btn-warning">Cari Resep Farmasi</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                            <table id="full" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        @if(Auth::user()->status !== 'Patient')
                                        <th>Nama Pasien</th>
                                        @endif
                                        <th>Nama Dokter</th>
                                        <th>Jumlah Biaya</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($result as $r_result)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        @if(Auth::user()->status !== 'Patient')
                                        <td>{{ DB::table('patient')->where('id', $r_result->doctor_id)->value('name') }}</td>
                                        @endif
                                        <td>{{ DB::table('doctor')->where('id', $r_result->doctor_id)->value('name') }}</td>
                                        <td><?php echo 'Rp. ' . number_format($r_result->amount, 0, '', ','); ?></td>
                                        <td>{{ $r_result->note }}</td>
                                        <td>
                                            @if(Auth::user()->status == 'Admin' || Auth::user()->status == 'Pharmacy')
                                            <a href="#" title="Lihat detail">
                                                <button class="btn btn-info disabled"><i class="fa fa-search-plus"></i></button>
                                            </a>
                                            <a href="#" title="Edit data">
                                                <button class="btn btn-warning disabled"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus data">
                                                <button class="btn btn-danger disabled"><i class="fa fa-trash"></i></button>
                                            </a>
                                            @else
                                            <a href="{{ url('patient/prescription/detail/'.$r_result->id) }}" title="Lihat detail">
                                                <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                            </a>
                                            @endif
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


<!-- Page script -->
<script src="{{ URL::asset('assets/admin-lte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
                                            //Date picker
                                            $('#datepicker').datepicker({
                                                autoclose: true
                                            })
</script>
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