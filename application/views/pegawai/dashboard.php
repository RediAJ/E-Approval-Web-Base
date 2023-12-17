<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pegawai/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Ditambahkan!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png" alt="AdminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Dashboard </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $approval['total_approval'] ?></h3>
                                    <br>
                                    <p>Data approval</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a href="<?= base_url(); ?>approval/view_pegawai/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $approval_acc['total_approval'] ?></h3>
                                    <br>
                                    <p>Data approval Diterima</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="<?= base_url(); ?>approval/view_pegawai/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $approval_reject['total_approval'] ?></h3>
                                    <br>
                                    <p>Data approval Ditolak</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-close-circled"></i>
                                </div>
                                <a href="<?= base_url(); ?>approval/view_pegawai/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $approval_confirm['total_approval'] ?></h3>
                                    <br>
                                    <p>Data approval Menunggu Konfirmasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-timer"></i>
                                </div>
                                <a href="<?= base_url(); ?>approval/view_pegawai/<?= $this->session->userdata('id_user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                    <h1>Syarat Permohonan approval</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Tahunan
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Tahunan : 12 Hari Kerja</h5>
                                    <p class="card-text">Aturan approval ini diberikan untuk PNS yang setidaknya sudah
                                        bekerja
                                        sekurang-kurangnya 1 tahun secara terus menerus. Dengan lamanya masa approval adalah
                                        12 hari
                                        kerja.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Besar
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Besar : 3 Bulan</h5>
                                    <p class="card-text">Jenis approval ini diberikan kepada mereka yang telah mengabdikan
                                        dirinya
                                        sekurang-kurangnya 6 tahun secara terus menerus. Durasi approval besar yang boleh
                                        diambil
                                        adalah 3 bulan.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Sakit
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Besar : 3 Bulan</h5>
                                    <p class="card-text">Bila PNS jatuh sakit dan tidak memungkinkan untuk melakukan
                                        pekerjaan,
                                        yang bersangkutan berhak atas approval sakit. Aturan approval PNS yang sakit diberikan 1
                                        hari
                                        atau 2 hari kerja dengan ketentuan bahwa ia harus memberitahukan kepada
                                        atasannya
                                        dan
                                        melampirkan surat keterangan dokter.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Melahirkan
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Melahirkan : 3 Bulan</h5>
                                    <p class="card-text">Untuk persalinan anak yang pertama, kedua, dan ketiga, PNS
                                        wanita
                                        berhak atas approval melahirkan. Namun, untuk persalinan anak keempat dan
                                        seterusnya,
                                        diberikan approval di luar tanggungan negara. Ketentuan lamanya approval melahirkan
                                        adalah 1
                                        bulan sebelum dan 2 bulan sesudah persalinan. approval ini diajukan secara tertulis
                                        dan
                                        selama menjalankan approval ini, PNS wanita masih berhak mendapatkan penghasilannya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Alasan Penting
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Alasan Penting : Maksimal 2 bulan</h5>
                                    <p class="card-text">approval alasan penting ini diberikan ketika ibu, bapak, istri,
                                        suami,
                                        anak, adik, kakak, mertua, atau menantu yang sedang sakit keras atau meninggal
                                        dunia.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    approval Bersama
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">approval Bersama</h5>
                                    <p class="card-text">Salah satu jenis approval yang pasti sudah tidak asing lagi. approval
                                        bersama
                                        ditetapkan oleh Presiden. Biasanya approval bersama ada saat perayaan Idulfitri,
                                        Natal
                                        dan
                                        tahun baru. Tentu saja, karena namanya approval bersama, approval ini tidak perlu
                                        diajukan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            approval di Luar Tanggungan Negara
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">approval di Luar Tanggungan Negara</h5>
                            <p class="card-text">Jenis approval ini diberikan kepada PNS yang telah bekerja
                                sekurang-kurangnya 5 tahun secara terus menerus karena alasan-alasan pribadi yang
                                penting dan mendesak dapat diberikan approval di luar tanggungan negara. approval di luar
                                tanggungan negara dapat diberikan paling lama 3 tahun. Jangka waktu approval di luar
                                tanggungan negara dapat diperpanjang paling lama 1 tahun apabila ada alasan-alasan yang
                                penting untuk memperpanjangnya.
                            </p>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("pegawai/components/js.php") ?>
</body>

</html>
