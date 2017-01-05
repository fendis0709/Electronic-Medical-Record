@extends((Auth::user()->status == 'Admin' ? 'layouts.layout-admin' : (Auth::user()->status == 'Doctor' ? 'layouts.layout-doctor' : ( Auth::user()->status == 'Lab' ? 'layouts.layout-lab' : (Auth::user()->status == 'Pharmacy' ? 'layouts.layout-pharmacy' : 'layouts.layout-patient')))))

@section('css')

<title>EMR Admin | Manajemen Pemeriksaan</title>
<!-- DataTables -->
<!--<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">-->

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan
            <small>Hasil Pencarian Pemeriksaan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan</li>
            <li class="active">Cari Pemeriksaan</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hasil Pencarian Pemeriksaan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        if ($form == 'search') {
                            ?>
                            <form class="form-horizontal" method="POST" action="{{ url('admin/checkup/search') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Tanggal Pemeriksaan</label>

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
                                            <button type="submit" class="btn btn-warning">Cari Pemeriksaan</button>
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
                                    <th>Nama Dokter</th>
                                    @if(Auth::user()->status !== 'Patient')
                                    <th>Nama Pasien</th>
                                    @endif
                                    <th>Gejala</th>
                                    <th>Hasil</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $r_result)
                                <tr>
                                    <td>{{ DB::table('doctor')->where('id', $r_result->doctor_id)->value('name') }}</td>
                                    @if(Auth::user()->status !== 'Patient')
                                    <td>{{ DB::table('patient')->where('id', $r_result->patient_id)->value('name') }}</td>
                                    @endif
                                    <td>{{ $r_result->symtomp }}</td>
                                    <td>{{ $r_result->result }}</td>
                                    <td>{{ date('d-M-Y', strtotime($r_result->date)) }}</td>
                                    <td>
                                    @if(Auth::user()->status == 'Doctor')
                                        <a href="{{ url('doctor/checkup/detail/'.$r_result->id) }}" title="Lihat detail">
                                    @elseif(Auth::user()->status == 'Patient')
                                        <a href="{{ url('patient/checkup/detail/'.$r_result->id) }}" title="Lihat detail">
                                    @elseif(Auth::user()->status == 'Admin')
                                        <a href="{{ url('admin/checkup/detail/'.$r_result->id) }}" title="Lihat detail">
                                    @endif
                                            <button class="btn btn-info"><i class="fa fa-search-plus"></i></button>
                                        </a>
                                    @if(Auth::user()->status == 'Admin')
                                        <a href="#" title="Edit data">
                                            <button class="btn btn-warning disabled"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')" title="Hapus data">
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