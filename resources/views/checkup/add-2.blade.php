<?php
/*
 * if session->user.status == admin
 *  layout.admin
 * else if session->user.status == doctor
 *  layout.doctor
 */
?>

@extends('layouts.layout-admin')

@section('css')

<title>EMR | Tambahkan Pemeriksaan</title>
<!-- Select2 -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/select2/select2.min.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datepicker/datepicker3.css') }} ">

@stop

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan
            <small>Tambahkan Pemeriksaan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan</li>
            <li class="active">Tambahkan Pemeriksaan</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Tambahkan Pemeriksaan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <form class="form-horizontal" method="POST" action="{{ url('admin/checkup/add_submit') }}"> <!-- form -->
                                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                <input name="patient" value="{{ $patient }}" type="hidden"/>
                                <input name="type" value="{{ $checkup_type }}" type="hidden"/>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Nama {{ ($checkup_type == 'Doctor' ? 'Dokter' : ( $checkup_type == 'Pharmacy' ? 'Farmasi' : $checkup_type ))  }} </label>

                                    <div class="col-sm-6">
                                        <select class="form-control select2" style="width: 100%;" name="to">
                                            <option disabled>--Pilih--</option>
                                            @foreach($data as $r_data)
                                            <option value="{{ $r_data->id }}">{{ $r_data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
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
                                            <button type="submit" class="btn btn-warning">Tambahkan Pemeriksaan</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop

@section('js')

<!-- Select2 -->
<!--<script src="{{ URL::asset('assets/admin-lte/plugins/select2/select2.full.min.js') }}"></script>-->
<!-- Date Picker -->
<!--<script src="{{ URL::asset('assets/admin-lte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>-->
<script>
//Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
    //Initialize Select2 Elements
    $(".select2").select2();


    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
        $('#state').on('change', function (e) {
                console.log(e);
                var state_id = e.target.value;

                $.get('{{ url('information') }}/admin/checkup/add?checkup_type=' + state_id, function (data) {
                        console.log(data);
                        $('#city').empty();
                        $.each(data, function (index, subCatObj) {
                                $('#city').append('' + subCatObj.name + '');
                        });
                });
        });
</script>

@stop