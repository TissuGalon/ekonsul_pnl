<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>E-Konsul</title>
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
       <?php include 'dosen-topbar.php'; ?>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <?php include 'dosen-sidebar.php'; ?>
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
                            <!-- <h4 class="fs-18 fw-semibold m-0">Kelola Bimbingan</h4> -->
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
                                    <h4 class="card-title mb-0 text-white">Bimbingan Selesai</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Prodi</th>
                                                    <th>Jenis Bimbingan</th>
                                                    <th>Topik Bimbingan</th>
                                                    <th>Waktu</th>
                                                    <th>Lampiran</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>2022573010098</td>
                                                    <td>Muhammad Kholis</td>
                                                    <td>TI</td>
                                                    <td>Akademik</td>
                                                    <td>Topik</td>
                                                    <td>Senin,11 November 2024 13:00 - 14:00</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary text-truncate"
                                                            style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <i data-feather="file-text"></i> Lorem ipsum dolor sit amet
                                                            consectetur, adipisicing elit. Pariatur quod error
                                                            aspernatur sed recusandae dicta voluptatibus harum, ipsa
                                                            nostrum omnis, voluptatum dignissimos quas atque explicabo
                                                            dolor neque tempora, at fugiat?
                                                        </a>

                                                    </td>
                                                    <td>
                                                        <div class="badge text-bg-primary">Selesai</div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td colspan="10" class="text-center">Belum ada data</td>
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