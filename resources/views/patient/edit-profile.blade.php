@extends((Auth::user()->status == 'Patient' ? 'layouts.layout-patient' : 'layouts.layout-admin'))

@section('css')

<title>EMR Pasien | Edit Profil</title>

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil
            <small>Ubah profil</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="">Profil</li>
            <li class="active">Ubah Profil</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-4">

                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        @foreach($patient as $r_patient)
                        <h3 class="widget-user-username">{{ $r_patient->name }}</h3>
                        <h5 class="widget-user-desc">Pasien</h5>
                        @endforeach
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User Avatar">
                    </div>
                    <div class="box-footer" style="margin-top: 30px">
                        <a href="#" class="btn btn-danger btn-block hidden"><b>Keluar</b></a>
                    </div>
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Ubah Profil</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <form class="form-horizontal" action="{{ url('admin/patient/edit') }}" method="POST" enctype="multipart/form-data">
                                @foreach($patient as $r_patient)
                                @foreach($account as $r_account)
                                <input type="hidden" name="from" value="{{ $from }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">NIK</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <input name="nik" type="text" class="form-control" value="<?php echo $r_patient->nik ?>" disabled>
                                            <input name="nik" type="hidden" class="form-control" value="<?php echo $r_patient->nik ?>">
                                        </div>
                                    </div>
                                </div>
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
                                            <input name="name" type="text" class="form-control" id="inputEmail" placeholder="Nama" value="<?php echo $r_patient->name ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Jenis Kelamin</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-transgender"></i>
                                            </div>
                                            <select class="form-control" name="gender">
                                                <option disabled>--Pilih Jenis Kelamin--</option>
                                                <option value="L" <?php echo ($r_patient->gender == 'L' ? 'selected' : '') ?>>Laki - Laki</option>
                                                <option value="P" <?php echo ($r_patient->gender == 'P' ? 'selected' : '') ?>>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Tanggal Lahir</label>

                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="birth_date" type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('m/d/Y', strtotime($r_patient->birth_date)) ?>">
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
                                                <option value="Gresik" <?php echo ($r_patient->city == 'Gresik' ? 'selected' : '') ?>>Gresik</option>
                                                <option value="Sidoarjo" <?php echo ($r_patient->city == 'Sidoarjo' ? 'selected' : '') ?>>Sidoarjo</option>
                                                <option value="Surabaya" <?php echo ($r_patient->city == 'Surabaya' ? 'selected' : '') ?>>Surabaya</option>
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
                                            <textarea name="address" class="form-control" id="inputExperience" placeholder="Alamat"><?php echo $r_patient->address ?></textarea>
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
                                            <input name="mobile" type="text" class="form-control" id="inputSkills" placeholder="Nomor Ponsel" value="<?php echo $r_patient->mobile ?>">
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
                                            <input name="telephone" type="text" class="form-control" id="inputSkills" placeholder="Nomor Telepon" value="<?php echo $r_patient->telephone ?>">
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
                                        <button type="submit" class="btn btn-warning">Perbarui data Pasien</button>
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