<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- App css -->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default" <!-- Begin page -->
    <div id="app-layout">


        <!-- Topbar Start -->
        <?php include 'component/admin-topbar.php' ?>
        <!-- end Topbar -->
        
        <!-- Left Sidebar Start -->
        <?php include 'component/admin-sidebar.php' ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content -->
                <div class="container-fluid">
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Dashboard </h4>
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">

                        <div class="col-12">
                            <div class="row g-3">

                                <!-- Data Mahasiswa -->
                                <div class="col-md-6 col-xl-6">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="widget-first">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div
                                                        class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-pill me-2">
                                                        <div class="bg-primary rounded-circle widget-size text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path fill="#ffffff"
                                                                    d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 text-dark fs-15">Data Mahasiswa</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="mb-0 fs-22 text-black me-3">200</h3>
                                                    <p class="text-dark fs-13 mb-0">Mahasiswa Aktif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Dosen -->
                                <div class="col-md-6 col-xl-6">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="widget-first">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div
                                                        class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-pill me-2">
                                                        <div
                                                            class="bg-secondary rounded-circle widget-size text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path fill="#ffffff"
                                                                    d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 text-dark fs-15">Data Dosen</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="mb-0 fs-22 text-black me-3">30</h3>
                                                    <p class="text-dark fs-13 mb-0">Dosen Aktif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pembagian Bimbingan -->
                                <div class="col-md-6 col-xl-6">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="widget-first">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div
                                                        class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-pill me-2">
                                                        <div class="bg-danger rounded-circle widget-size text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="#ffffff"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M19 9H6.659c-1.006 0-1.51 0-1.634-.309c-.125-.308.23-.672.941-1.398L8.211 5M5 15h12.341c1.006 0 1.51 0 1.634.309c.125.308-.23.672-.941 1.398L15.789 19"
                                                                    color="#ffffff"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 text-dark fs-15">Pembagian Bimbingan</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="mb-0 fs-22 text-black me-3">45</h3>
                                                    <p class="text-dark fs-13 mb-0">Bimbingan Terdaftar</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Riwayat Bimbingan -->
                                <div class="col-md-6 col-xl-6">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div class="widget-first">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div
                                                        class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-pill me-2">
                                                        <div class="bg-warning rounded-circle widget-size text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24">
                                                                <path fill="#ffffff"
                                                                    d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 text-dark fs-15">Data Riwayat Bimbingan</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="mb-0 fs-22 text-black me-3">150</h3>
                                                    <p class="text-dark fs-13 mb-0">Bimbingan</p>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="../assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>

    <!-- Apexcharts JS -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- for basic area chart -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!-- Widgets Init Js -->
    <script src="../assets/js/pages/crm-dashboard.init.js"></script>

    <!-- App js-->
    <script src="../assets/js/app.js"></script>

</body>

</html>