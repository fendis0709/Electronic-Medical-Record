    <!-- jQuery 2.2.3 -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ URL::asset('assets/admin-lte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ URL::asset('assets/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('assets/admin-lte/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('assets/admin-lte/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('assets/admin-lte/dist/js/demo.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!--Sweet alert plugins-->
    <script src="{{ URL::asset('assets/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ URL::asset('assets/admin-lte/plugins/select2/select2.full.min.js') }}"></script>
    <script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        $('#full').DataTable();
        $('#custom').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    function swal({
        title: "Anda yakin?",
        text: "Data yang telah terhapus tidak dapat dikembalikan lagi!",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Batalkan!",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus data ini!",
        closeOnConfirm: false,
        html: false
      }, function(){
        swal("Terhapus!",
        "Data yang telah Anda pilih, telah terhapus.",
        "success");
      });
    </script>