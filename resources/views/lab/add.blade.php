@extends('layouts.layout-admin')

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
                            <form class="form-horizontal" action="{{ url('admin/lab/add') }}" method="POST" enctype="multipart/form-data">
                                @if(count($errors))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <strong>Oops!</strong> Sepertinya ada beberapa kesalahan dalam memasukkan data Anda.
                                            <br/>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="inputName" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input name="email" type="email" class="form-control" id="inputName" placeholder="Email" value="{{ old('email') }}"/>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="inputEmail" class="col-sm-2 control-label">Nama</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input name="name" type="text" class="form-control" id="inputEmail" placeholder="Nama" value="{{ old('name') }}"/>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                    <label for="inputSkills" class="col-sm-2 control-label">Kota</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <select class="form-control" name="city">
                                                <option selected disabled>--Pilih kota--</option>
                                                <option value="Gresik" {{ (old('nik') == 'Gresik' ? 'selected' : '') }}>Gresik</option>
                                                <option value="Sidoarjo" {{ (old('nik') == 'Sidoarjo' ? 'selected' : '') }}>Sidoarjo</option>
                                                <option value="Surabaya" {{ (old('nik') == 'Surabaya' ? 'selected' : '') }}>Surabaya</option>
                                            </select>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="inputSkills" class="col-sm-2 control-label">Alamat</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <textarea name="address" class="form-control" id="inputExperience" placeholder="Alamat">{{ old('address') }}</textarea>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                    <label for="inputSkills" class="col-sm-2 control-label">Ponsel</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-mobile-phone"></i>
                                            </div>
                                            <input name="mobile" type="text" class="form-control" id="inputSkills" placeholder="Nomor Ponsel" value="{{ old('mobile') }}"/>
                                        </div>
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                    <label for="inputSkills" class="col-sm-2 control-label">Telepon</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input name="telephone" type="text" class="form-control" id="inputSkills" placeholder="Nomor Telepon" value="{{ old('telephone') }}"/>
                                        </div>
                                            <span class="text-danger">{{ $errors->first('telephone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input name="photo" type="file" id="exampleInputFile" accept="image/*">

                                        <p class="help-block">File maksimum berukuran 500KB.</p>
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-warning">Tambahkan Laboratorium</button>
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