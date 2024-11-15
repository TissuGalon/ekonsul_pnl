<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Shared on THEMELOCK.COM - Dashboard | Silva - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default" <!-- Begin page -->
    <div id="app-layout">


        <!-- Topbar Start -->
        <?php include 'mahasiswa-topbar.php'; ?>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                   <?php include 'mahasiswa-sidebar.php'; ?>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Registrasi Konseling</h4>
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <div class="card-icon">
                                        <i class="fas fa-edit fs-14 text-muted white"></i>
                                    </div>
                                    <h4 class="card-title mb-0 text-white">Pendaftaran Konseling</h4>
                                </div>
                                <div class="card-body">
                                    <form action="controller/mahasiswa/daftar_konseling.php" method="POST">
                                        <div class="col-md-12 mb-3">
                                            <label for="inputDosen" class="form-label">Dosen</label>
                                            <select name="lecturer_id" class="form-select form-select-lg" required>
                                                <option selected="selected">Pilih Dosen</option>
                                                <!-- Options here -->
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="inputTipeKonseling" class="form-label">Tipe Konseling</label>
                                            <select name="tipe_konseling" class="form-select form-select-lg" required>
                                                <option selected="selected">Pilih Tipe</option>
                                                <option value="Baru">Baru</option>
                                                <option value="Lanjut">Lanjut</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="inputTujuanKonseling" class="form-label">Tujuan
                                                Konseling</label>
                                            <select name="tujuan_konseling" class="form-select form-select-lg" required>
                                                <option selected="selected">Pilih Tujuan</option>
                                                <option value="Bimbingan Tugas Akhir">Bimbingan Tugas Akhir</option>
                                                <option value="Bimbingan Akademik">Bimbingan Akademik</option>
                                                <option value="Bimbingan PKL">Bimbingan PKL</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="inputJenisKonseling" class="form-label">Jenis Konseling</label>
                                            <select name="jenis_konseling" class="form-select form-select-lg" required>
                                                <option selected="selected">Pilih Jenis</option>
                                                <option value="Online">Online</option>
                                                <option value="Offline">Offline</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="inputTanggal" class="form-label">Tanggal Konseling</label>
                                            <input type="date" id="example-date" class="form-control" name="date">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="inputMulai" class="form-label">Jam Mulai</label>
                                                <input type="time" id="example-time" class="form-control"
                                                    name="time-start">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputSelesai" class="form-label">Jam Selesai</label>
                                                <input type="time" id="example-time" class="form-control"
                                                    name="time-end">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>
                                            Daftar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>document.write(new Date().getFullYear())</script> - Made with <span
                                class="mdi mdi-heart text-danger"></span> by <a href="#!"
                                class="text-reset fw-semibold">Zoyothemes</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- Apexcharts JS -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- for basic area chart -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!-- Widgets Init Js -->
    <script src="assets/js/pages/crm-dashboard.init.js"></script>

    <!-- App js-->
    <script src="assets/js/app.js"></script>

</body>

</html>