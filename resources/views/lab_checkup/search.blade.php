<?php
/*
 * If (session->user.status == 'admin'){
 *  use layout-admin
 * } elseif(session->user.status == 'lab'){
 *  use layout-lab
 * } elseif(session->user.status == 'doctor'){
 *  use layout-doctor
 * } elseif(session->user.status == 'pharmacy'){
 *  use layout-pharmacy
 * } elseif(session->user.status == 'patient'){
 *  use layout-patient
 * }
 */
?>
@extends((Auth::user()->status == 'Admin' ? 'layouts.layout-admin' : (Auth::user()->status == 'Doctor' ? 'layouts.layout-doctor' : ( Auth::user()->status == 'Lab' ? 'layouts.layout-lab' : (Auth::user()->status == 'Pharmacy' ? 'layouts.layout-pharmacy' : 'layouts.layout-patient')))))

@section('css')

<title>EMR | Cari Pemeriksaan Lab</title>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datepicker/datepicker3.css') }} ">

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan Laboratorium
            <small>Cari Pemeriksaan Laboratorium</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan Laboratorium</li>
            <li class="active">Cari Pemeriksaan Laboratorium</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Cari Pemeriksaan Laboratorium</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            @if(Auth::user()->status == 'Lab')
                            <form class="form-horizontal" method="POST" action="{{ url('lab/checkup/search') }}">
                            @elseif(Auth::user()->status == 'Patient')
                            <form class="form-horizontal" method="POST" action="{{ url('patient/lab/search') }}">
                            @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Tanggal Pemeriksaan</label>

                                    <div class="col-sm-6">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="date" type="text" class="form-control pull-right" id="datepicker">
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
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>

@stop

@section('js')

<!-- Page script -->
<script src="{{ URL::asset('assets/admin-lte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
//Date picker
$('#datepicker').datepicker({
    autoclose: true
})
</script>

@stop