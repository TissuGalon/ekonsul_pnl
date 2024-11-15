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
                    <h4 class="fs-18 fw-semibold m-0">Data Konseling</h4>
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
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tujuan Konseling</th>
                                            <th>Tipe Konseling</th>
                                            <th>Tanggal Konseling</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Online</td>
                                            <td>Bimbingan Tugas Akhir</td>
                                            <td>11/10/2024</td>
                                            <td>
                                                <div class="badge text-bg-primary">Diproses</div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="#!" class="btn btn-primary btn-icon">
                                                    <i>Chat</i>
                                                    <div class="btn-marker"></div>
                                                </a>
                                                <div class="mx-1"></div>
                                                <a href="#!" class="btn btn-secondary btn-icon">
                                                    <i>Lihat</i>
                                                    <div class="btn-marker"></div>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Online</td>
                                            <td>Bimbingan Tugas Akhir</td>
                                            <td>11/10/2024</td>
                                            <td>
                                                <div class="badge text-bg-primary">Diproses</div>
                                            </td>
                                            <td class="d-flex">
                                                <a href="#!" class="btn btn-primary btn-icon">
                                                    <i>Chat</i>
                                                    <div class="btn-marker"></div>
                                                </a>
                                                <div class="mx-1"></div>
                                                <a href="#!" class="btn btn-secondary btn-icon">
                                                    <i>Lihat</i>
                                                    <div class="btn-marker"></div>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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