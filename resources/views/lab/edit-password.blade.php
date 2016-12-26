@extends('layouts.layout-lab')

@section('css')

<title>EMR Lab | Edit Password</title>

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil
            <small>Ubah password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Profil</li>
            <li class="active">Ubah Password</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-4">

                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username">Elizabeth Pierce</h3>
                        <h5 class="widget-user-desc">Web Designer</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User Avatar">
                    </div>
                    <div class="box-footer" style="margin-top: 30px">
                        <a href="#" class="btn btn-danger btn-block"><b>Keluar</b></a>
                    </div>
                </div>
                <!-- Profile Image -->
                <div class="box box-primary hidden">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('assets/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User profile picture">

                        <h3 class="profile-username text-center">Alexander Pierce</h3>

                        <p class="text-muted text-center">Admin Master</p>

                        <a href="#" class="btn btn-danger btn-block"><b>Keluar</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#password" data-toggle="tab">Ubah Password</a></li>
                    </ul>
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="password">
                            <form class="form-horizontal" action="{{ url('lab/profile/edit/password') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="email" value="{{ Auth::user()->email }}" type="hidden"/>
                                <div class="row">
                                    <?php if (NULL !== (Session::get('message'))) {
                                        ?>
                                        <div class="col-md-push-1 col-md-10">
                                            <div class="box box-danger box-solid">
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
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-4 control-label">Password lama</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input name="password" type="password" class="form-control" id="inputName" placeholder="Recent Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-4 control-label">Password baru</label>

                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input name="password_new" type="password" class="form-control" id="inputName" placeholder="New Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-4 control-label">Masukkan lagi password baru</label>

                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input name="password_new_verify" type="password" class="form-control" id="inputName" placeholder="Repeat New Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-10">
                                        <button type="submit" class="btn btn-warning">Ubah Password</button>
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