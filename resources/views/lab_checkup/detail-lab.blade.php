@extends(Auth::user()->status == 'Lab' ?'layouts.layout-lab' : (Auth::user()->status == 'Patient' ? 'layouts.layout-patient' : 'layouts.layout-admin'))

@section('css')

<title>EMR Dokter | Lihat Pemeriksaan</title>

@stop

@section('content')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pemeriksaan
            <small>Lihat Pemeriksaan Pasien</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Pemeriksaan</li>
            <li class="active">Lihat Pemeriksaan</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Pemeriksaan Pasien</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <h4>Data pemeriksaan pasien</h4>
                            <div class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Tanggal Pemeriksaan</p>
                                            </div>
                                            @foreach($lab_checkup as $r_lab_checkup)
                                            <div class="col-md-8">
                                                <p>{{ date('d-M-Y', strtotime($r_lab_checkup->date)) }}</p>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Nama Lab</p>
                                            </div>
                                            <div class="col-md-8">
                                                @foreach($lab as $r_lab)
                                                <p>{{ $r_lab->name }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @foreach($patient as $r_patient)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Nama Pasien</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p>{{ $r_patient->name }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if($checkup !== NULL)
                                    @foreach($checkup as $r_checkup)
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Gejala</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p>{{ $r_checkup->symtomp }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Hasil Pemeriksaan</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p>{{ $r_checkup->result }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Catatan</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p>{{ $r_checkup->note }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p style="">Foto hasil pemeriksaan</p>
                                            </div>
                                            <div class="col-md-8">
                                                <a href="{{ url($r_checkup->photo) }}" target="_blank">
                                                    <button class="btn btn-info">Lihat foto hasil lab</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <!-- Horizontal Form -->
                                <div class="box box-info" style="margin-top: 20px">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Hasil Lab Pasien</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="form-horizontal">
                                        @if(count($lab_checkup) !== 0)
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box">
                                                    <div class="box-header">
                                                        <div class="box-tools hidden">
                                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                                                <div class="input-group-btn">
                                                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body table-responsive no-padding">
                                                        <div class="row" style="margin: 25px 0px 0px 15px">
                                                            @foreach($lab_checkup as $r_lab)
                                                            <div class="col-md-2">
                                                                <p style="font-weight: bold">Hasil</p>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <p style="font-weight: bold">{{ $r_lab->result }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin: 25px 0px 0px 15px">
                                                            <div class="col-md-2">
                                                                <p>Catatan</p>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <p>{{ $r_lab->notes }}</p>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
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