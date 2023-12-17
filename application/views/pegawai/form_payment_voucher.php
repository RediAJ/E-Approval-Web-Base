<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pegawai/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Berhasil!",
        text: "Data Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Data Gagal Ditambahkan!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("pegawai/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("pegawai/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Form Permohonan Penghapusan Data Pengguna</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Approval</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form id="yourForm" action="<?= base_url();?>Form_approval/generatePdf" method="POST" enctype="multipart/form-data">
                        <input type="text" value="<?=$this->session->userdata('id_user') ?>" name="id_user" hidden>

                        <!-- Autocomplete field -->
                        <div class="form-group">
                            <label for="autofill">Nama Lengkap</label>
                            <input type="text" class="form-control" name="autofill" id="autofill" aria-describedby="perihal_approval" readonly />
                        </div>

                        <!-- Input for the first data -->
                        <div class="form-group">
                            <label for="input_data1">No Telp</label>
                            <input type="text" class="form-control" name="input_data1" id="input_data1" placeholder="Masukkan No Telp" aria-describedby="perihal_approval" />
                        </div>

                        <div class="form-group">
                            <label for="input_data2">No KTP</label>
                            <input type="text" class="form-control" name="input_data2" id="input_data2" placeholder="Masukkan No KTP" aria-describedby="perihal_approval" />
                        </div>

                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" id="alasan" rows="3" name="alasan" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">PDF Terhasilkan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Iframe untuk menampilkan PDF yang terhasilkan -->
                        <iframe id="pdfViewer" width="100%" height="500"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="acceptPdf()">Terima</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Konten sidebar kontrol disini -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("pegawai/components/js.php") ?>

    <!-- Sertakan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Logika AJAX dan autofill Anda -->
<script>
    $(document).ready(function() {
        $('#input_data1').on('input', function() {
            var input_data1 = $('#input_data1').val();
            $.ajax({
                url: "<?php echo site_url('Form_approval/fetchData'); ?>",
                type: 'POST',
                data: { input_data1: input_data1 },
                dataType: 'json',
                success: function(data) {
                    $('#input_data2').val(data.no_ktp);
                    $('#autofill').val(data.nama_lengkap);
                }
            });
        });

        $('#input_data2').on('input', function() {
            var input_data2 = $('#input_data2').val();
            $.ajax({
                url: "<?php echo site_url('Form_approval/fetchData'); ?>",
                type: 'POST',
                data: { input_data2: input_data2 },
                dataType: 'json',
                success: function(data) {
                    $('#input_data1').val(data.no_telp);
                    $('#autofill').val(data.nama_lengkap);
                }
            });
        });

        $('#yourForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'Form_approval/generatePdf', // Sesuaikan dengan nama controller yang benar
        data: $(this).serialize(),
        success: function(response) {
            $('#pdfViewer').attr('src', 'data:application/pdf;base64,' + response);
            $('#pdfModal').modal('show');
        }
    });
});


        // Fungsi untuk menangani klik tombol "Terima"
        function acceptPdf() {
            // Implementasikan logika Anda di sini
            // Fungsi ini akan dipanggil saat pengguna mengklik "Terima" di modal
        }
    });
</script>


</body>

</html>
