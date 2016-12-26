@extends(Auth::user()->status == 'Lab' ?'layouts.layout-lab' : 'layouts.layout-admin')

@section('css')

<title>EMR Admin | Tambah Laboratorium</title>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/datepicker/datepicker3.css') }} ">

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laboratorium
            <small>Tambah Laboratorium</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Laboratorium</li>
            <li class="active">Tambah Laboratorium</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Tambah Laboratorium</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <div class="row">
                                <?php if (NULL !== (Session::get('message'))) {
                                    ?>
                                    <div class="col-md-push-3 col-md-6">
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
                            @if(Auth::user()->status == 'Admin')
                            <form class="form-horizontal" action="{{ url('admin/lab/edit') }}" method="POST" enctype="multipart/form-data">
                            @elseif(Auth::user()->status == 'Lab')
                            <form class="form-horizontal" action="{{ url('lab/profile/edit') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @foreach($lab as $r_lab)
                                @foreach($account as $r_account)
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input name="email" type="text" class="form-control" id="inputName" placeholder="Email" value="<?php echo $r_account->email ?>" disabled>
                                            <input name="email" type="hidden" class="form-control" id="inputName" placeholder="Email" value="<?php echo $r_account->email ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Nama</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input name="name" type="text" class="form-control" id="inputEmail" placeholder="Nama" value="{{ $r_lab->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Kota</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <select class="form-control" name="city">
                                                <option disabled>--Pilih kota--</option>
                                                <option value="Gresik" {{ ($r_lab->city == 'Gresik' ? 'selected' : '' ) }}>Gresik</option>
                                                <option value="Sidoarjo" {{ ($r_lab->city == 'Sidoarjo' ? 'selected' : '' ) }}>Sidoarjo</option>
                                                <option value="Surabaya" {{ ($r_lab->city == 'Surabaya' ? 'selected' : '' ) }}>Surabaya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Alamat</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <textarea name="address" class="form-control" id="inputExperience" placeholder="Alamat">{{ $r_lab->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Ponsel</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-mobile-phone"></i>
                                            </div>
                                            <input name="mobile" type="text" class="form-control" id="inputSkills" placeholder="Nomor Ponsel" value="{{ $r_lab->mobile }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Telepon</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input name="telephone" type="text" class="form-control" id="inputSkills" placeholder="Nomor Telepon" value="{{ $r_lab->telephone }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input name="photo" type="file" id="exampleInputFile" accept="image/*">

                                        <p class="help-block">File maksimum berukuran 500KB.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-warning">Perbarui data Laboratorium</button>
                                    </div>
                                </div>
                                @endforeach
                                @endforeach
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
});
</script>

@stop