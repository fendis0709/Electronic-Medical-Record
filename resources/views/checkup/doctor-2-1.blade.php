@extends('layouts.layout-doctor')

@section('css')

<title>EMR Dokter | Isi Pemeriksaan</title>

@stop

@section('content')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan
            <small>Isi Pemeriksaan Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan</li>
            <li class="active">Isi Pemeriksaan</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-10">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Pemeriksaan Pasien</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <h4>Data rujukan pasien</h4>
                            <form class="form-horizontal" action="{{ url('doctor/checkup/step_2_lab_submit') }}" method="POST">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                @foreach($checkup as $r_checkup)
                                @foreach($patient as $r_patient)
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <p style="font-weight: bold;">Nama Pasien </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p style="font-weight: bold">{{ $r_patient->name }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <p>Gejala</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ $r_checkup->symtomp }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <p>Hasil Pemeriksaan</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ $r_checkup->result }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <p>Catatan</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ $r_checkup->note }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @endforeach
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Tujuan Lab</label>

                                    <div class="col-sm-6">
                                        <select class="form-control select2" name="lab" id="category" style="width: 100%;" required>
                                            <option selected="selected" disabled value="">--Pilih tujuan rujukan--</option>
                                            @foreach($lab as $r_lab)
                                            <option value="{{ $r_lab->id }}">{{ $r_lab->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Jika dokter memilih farmasi -->
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
                                        <button type="submit" class="btn btn-warning">Submit data pemeriksaan</button>
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

<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
    $('#category').on('change', function (e) {
        var cat_id = e.target.value;
        //ajax
        $.get('/doctor/checkup/category-dropdown?category=' + cat_id, function (data) {
            //success data
            $('#subcategory').empty();
            $('#subcategory').append(' Please choose one');
            $.each(data, function (index, subcatObj) {
                $('#subcategory').append(''
                        + subcatObj.subcategory_name + '</option>');
            });
        });
    });
</script>

@stop