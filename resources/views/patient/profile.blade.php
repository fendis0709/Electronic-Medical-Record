@extends((Auth::user()->status == 'Patient' ? 'layouts.layout-patient' : 'layouts.layout-admin'))

@section('css')

<title>EMR Pasien | Profil</title>

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Profil</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-4">

                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <?php
                        foreach ($patient as $r_patient) {
                            ?>
                            <h3 class="widget-user-username">{{ $r_patient->name }}</h3>
                            <?php
                        }
                        ?>
                        <h5 class="widget-user-desc">Pasien</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ URL::asset('assets/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User Avatar">
                    </div>
                    <div class="box-footer" style="margin-top: 30px">
                        <a href="#" class="btn btn-danger btn-block hidden"><b>Keluar</b></a>
                    </div>
                </div>
                <!-- Profile Image -->
                <div class="box box-primary hidden">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('assets/admin-lte/dist/img/user8-128x128.jpg') }}" alt="User profile picture">

                        <h3 class="profile-username text-center">Alexander Pierce</h3>

                        <p class="text-muted text-center"></p>

                        <a href="#" class="btn btn-danger btn-block" style="visibility: hidden"><b>Keluar</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Informasi Dasar</a></li>
                        <li><a href="#timeline" data-toggle="tab">Riwayat Aktifitas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
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
                            <?php
                            foreach ($patient as $r_patient) {
                                foreach ($account as $r_account) {
                                    ?>
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                NIK
                                            </div>
                                            <div class="col-md-9">
                                                {{ $r_patient->nik }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Email
                                            </div>
                                            <div class="col-md-9">
                                                {{ $r_account->email }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Nama
                                            </div>
                                            <div class="col-md-9">
                                                {{ $r_patient->name }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-md-9">
                                                {{ $r_patient->gender == 'L' ? 'Laki - laki' : 'Perempuan'}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-9">
                                                <?php echo date('d-M-Y', strtotime($r_patient->birth_date)) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Kota
                                            </div>
                                            <div class="col-md-9">
                                                {{$r_patient->city}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Alamat
                                            </div>
                                            <div class="col-md-9">
                                                {{$r_patient->address}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                No Ponsel
                                            </div>
                                            <div class="col-md-9">
                                                {{$r_patient->mobile}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Telepon
                                            </div>
                                            <div class="col-md-9">
                                                {{$r_patient->telephone}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post hidden">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Foto
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row margin-bottom">
                                                    <div class="col-sm-6">
                                                        <img class="img-responsive" src="{{ asset($r_patient->photo) }}" alt="Photo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="form-horizontal">
                                            <div class="form-group margin-bottom-none">
                                                <div class="col-md-4">
                                                </div>
                                                @if(Auth::user()->status == 'Patient')
                                                <div class="col-md-4">
                                                    <a href='{{ url('patient/profile/edit/password') }}'>
                                                        <button type="submit" class="btn btn-warning pull-right btn-block btn-sm">Ubah Password</button>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href='{{ url('patient/profile/edit') }}'>
                                                        <button type="submit" class="btn btn-info pull-right btn-block btn-sm">Ubah Profil</button>
                                                    </a>
                                                </div>
                                                @else
                                                <div class="col-md-4">
                                                    <a href='{{ url('admin/patient/edit/'.$r_patient->id) }}'>
                                                        <button type="submit" class="btn btn-info pull-right btn-block btn-sm">Ubah Profil</button>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        10 Feb. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
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
    <!-- /.content -->
</div>

<script>
//Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
</script>

@stop
