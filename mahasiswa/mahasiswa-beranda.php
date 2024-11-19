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
                            <h4 class="fs-18 fw-semibold m-0">Beranda</h4>
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title text-black mb-0"><i data-feather="info"></i> Berita
                                        </h5>
                                    </div>
                                </div>

                                <div class="card-body">
                                    -
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="height: 400px;">
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel"
                                        style="height: 100%;">
                                        <!-- Indicators -->
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                                                class="" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                                                aria-label="Slide 2" class="active" aria-current="true"></button>
                                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                                                aria-label="Slide 3" class=""></button>
                                        </div>

                                        <!-- Slides -->
                                        <div class="carousel-inner" style="height: 100%;">
                                            <div class="carousel-item active carousel-item-start" style="height: 100%;">
                                                <img src="http://ab.pnl.ac.id/assets/images/banner/home9.jpg"
                                                    class="d-block w-100" alt="Slide 1"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <!-- <h5>Slide 1</h5>
                                        <p>Deskripsi slide 1.</p> -->
                                                </div>
                                            </div>
                                            <div class="carousel-item carousel-item-next carousel-item-start"
                                                style="height: 100%;">
                                                <img src="http://ab.pnl.ac.id/assets/images/banner/home9.jpg"
                                                    class="d-block w-100" alt="Slide 2"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <!-- <h5>Slide 2</h5>
                                        <p>Deskripsi slide 2.</p> -->
                                                </div>
                                            </div>
                                            <div class="carousel-item" style="height: 100%;">
                                                <img src="http://ab.pnl.ac.id/assets/images/banner/home9.jpg"
                                                    class="d-block w-100" alt="Slide 3"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <!--    <h5>Slide 3</h5>
                                        <p>Deskripsi slide 3.</p> -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Controls (Previous & Next) -->
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
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
                                class="mdi mdi-heart text-danger"></span> by <a href="../#!"
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