@extends('layouts.layout-pharmacy')

@section('css')

<title>EMR Farmasi | Isi Resep</title>

@stop

@section('content')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resep
            <small>Isi Resep Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Resep</li>
            <li class="active">Isi Resep</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-10">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Resep Pasien</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <h4>Data resep pasien hari ini</h4>
                            <form class="form-horizontal" action="{{ url('pharmacy/prescription/step_1_submit') }}" method="POST">
                                <div class="row">
                                    <?php if (NULL !== (Session::get('message'))) {
                                        ?>
                                        <div class="col-md-push-1 col-md-10">
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
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p style="font-weight: bold; text-align: right">Tanggal</p>
                                        </div>
                                        <div class="col-md-10">
                                            <p style="font-weight: bold">{{ date('d-M-Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if(count($patient) == 0)
                                <p style="font-size: 26px; text-align: center">Tidak ada pasien </p>
                                @else
                                @foreach($patient as $r_patient)
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Pasien</label>

                                    <div class="col-sm-6">
                                        <select class="form-control select2" name="patient" style="width: 100%;">
                                            <option selected="selected" disabled>--Pilih pasien--</option>
                                            <option value="{{ $r_patient->id }}">{{ $r_patient->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-warning">Selanjutnya</button>
                                    </div>
                                </div>
                                @endif
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
    $('#category').on('change', function(e){
    var cat_id = e.target.value;
       //ajax
       $.get('/doctor/checkup/category-dropdown?category=' + cat_id, function(data){
           //success data
           $('#subcategory').empty();
           $('#subcategory').append(' Please choose one');
           $.each(data, function(index, subcatObj){
               $('#subcategory').append(''
               + subcatObj.subcategory_name + '</option>');
           });
       });
   });
</script>

@stop