@extends('layouts.layout-lab')

@section('css')

<title>EMR Lab | Isi Pemeriksaan</title>

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
                            <h4>Data pemeriksaan pasien hari ini</h4>
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
                            <form class="form-horizontal" action="{{ url('/lab/checkup/add') }}" method="POST">
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
                                @if(count($checkup) == 0)
                                <p style="font-size: 26px">Tidak ada pasien </p>
                                @else
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Nama Pasien</label>

                                    <div class="col-sm-6">
                                        <select name="patient" class="form-control select2" style="width: 100%;">
                                            <option selected="selected" disabled>--Pilih nama pasien--</option>
                                            @foreach($patient as $r_patient)
                                            <option value="{{ $r_patient->id }}">{{ $r_patient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Hasil Pemeriksaan</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                            <textarea name="result" class="form-control" id="inputExperience" placeholder="Hasil Pemeriksaan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Catatan Pemeriksaan</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-paperclip"></i>
                                            </div>
                                            <textarea name="note" class="form-control" id="inputExperience" placeholder="Catatan Pasien"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input name="photo" type="file" id="exampleInputFile">

                                        <p class="help-block">File maksimum berukuran 500KB.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-warning">Submit data</button>
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
    //Initialize Select2 Elements
    $(".select2").select2();


    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
</script>

@stop