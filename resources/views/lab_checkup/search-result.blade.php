@extends((Auth::user()->status == 'Admin' ? 'layouts.layout-admin' : (Auth::user()->status == 'Doctor' ? 'layouts.layout-doctor' : ( Auth::user()->status == 'Lab' ? 'layouts.layout-lab' : (Auth::user()->status == 'Pharmacy' ? 'layouts.layout-pharmacy' : 'layouts.layout-patient')))))

@section('css')

<title>EMR Admin | Manajemen Pemeriksaan Laboratorium</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan Laboratorium
            <small>Hasil Pencarian Pemeriksaan Laboratorium</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan Laboratorium</li>
            <li class="active">Cari Pemeriksaan Laboratorium</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hasil Pencarian Pemeriksaan Laboratorium</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        if ($form == 'search') {
                            ?>
                            @if(Auth::user()->status == 'Lab')
                            <form class="form-horizontal" method="POST" action="{{ url('lab/checkup/search') }}">
                            @elseif(Auth::user()->status == 'Patient')
                            <form class="form-horizontal" method="POST" action="{{ url('patient/lab/search') }}">
                            @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Tanggal Pemeriksaan Laboratorium</label>

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
                                            <button type="submit" class="btn btn-warning">Cari Pemeriksaan Laboratorium</button>
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
                                    <th>Nama Lab</th>
                                    <th>Nama Pasien</th>
                                    <th>Hasil</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $r_result)
                                <tr>
                                    <td>{{ DB::table('lab')->where('id', $r_result->lab_id)->value('name') }}</td>
                                    <td>{{ DB::table('patient')->where('id', $r_result->patient_id)->value('name') }}</td>
                                    <td>{{ $r_result->result }}</td>
                                    <td>{{ date('d-M-Y', strtotime($r_result->date)) }}</td>
                                    <td>
                                    @if(Auth::user()->status == 'Lab')
                                        <a href="{{ url('lab/checkup/detail/'.$r_result->id) }}" title="Lihat detail">
                                    @elseif(Auth::user()->status == 'Patient')
                                        <a href="{{ url('patient/lab/detail/'.$r_result->id) }}" title="Lihat detail">
                                    @endif
                                            <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                        </a>
                                    @if(Auth::user()->status == 'Admin')
                                        <a href="#" title="Edit data">
                                            <button class="btn btn-warning disabled"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus data">
                                            <button class="btn btn-danger disabled"><i class="fa fa-trash"></i></button>
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