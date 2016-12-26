@extends((Auth::user()->status == 'Admin' ? 'layouts.layout-admin' : (Auth::user()->status == 'Doctor' ? 'layouts.layout-doctor' : ( Auth::user()->status == 'Lab' ? 'layouts.layout-lab' : (Auth::user()->status == 'Pharmacy' ? 'layouts.layout-pharmacy' : 'layouts.layout-patient')))))

@section('css')

<title>EMR Dokter | Daftar Pasien Saya</title>
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
            <small>Pasien Dokter</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Dokter</li>
            <li class="active">Pasien Saya</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Pasien Dokter</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="full" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pasien</th>
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tgl Lahir</th>
                                    <th>Usia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($result as $r_result)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $r_result->name }}</td>
                                    <td>{{ $r_result->city }}</td>
                                    <td>{{ $r_result->address }}</td>
                                    <td>{{ ($r_result->gender == 'L' ? 'Laki - laki' : 'Perempuan' ) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($r_result->birth_date)) }}</td>
                                    <td>{{ DateTime::createFromFormat('Y-m-d', $r_result->birth_date, new DateTimeZone('Asia/Jakarta'))->diff(new DateTime('now', new DateTimeZone('Asia/Jakarta')))->y }}</td>
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