<?php 
require_once '../controller/koneksi.php';
$conn = getConnection();
 ?>

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

<body data-menu-color="light" data-sidebar="default">
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
                            <!-- <h4 class="fs-18 fw-semibold m-0">Pembagian BImbingan </h4> -->
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pembagian Bimbingan</h5>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#bydosen" role="tab"
                                                aria-selected="true">
                                                <span class="d-block d-sm-none"><i
                                                        class="mdi mdi-home-account"></i></span>
                                                <span class="d-none d-sm-block">By Dosen</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#bymahasiswa" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <span class="d-block d-sm-none"><i
                                                        class="mdi mdi-account-outline"></i></span>
                                                <span class="d-none d-sm-block">By Mahasiswa</span>
                                            </a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active show" id="bydosen" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Mahasiswa</th>
                                                            <th>Dosen Pembimbing</th>
                                                            <th>Jenis Bimbingan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $query = mysqli_query($conn, "SELECT * FROM pembagian_pembimbing");
                                                         ?>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Reza Zulman</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <!-- Dosen Pembimbing dengan gambar -->
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <!-- Jenis Bimbingan yang lebih terstruktur -->
                                                                <p>Akademik</p>
                                                                <p>Akademik</p>
                                                                <p>Akademik</p>
                                                            </td>
                                                            <td>
                                                                <!-- Tombol Aksi -->
                                                                <div class="d-grid gap-2" style="grid-template-columns: repeat(2, 1fr);">
                                                                    <a href="#" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>
                                                                    <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="bymahasiswa" role="tabpanel">
                                            <div class="table-responsive">
                                              <table class="table table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Mahasiswa</th>
                                                            <th>Dosen Pembimbing</th>
                                                            <th>Jenis Bimbingan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Reza Zulman</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <!-- Dosen Pembimbing dengan gambar -->
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <!-- Jenis Bimbingan yang lebih terstruktur -->
                                                                <p>Akademik</p>
                                                                <p>Akademik</p>
                                                                <p>Akademik</p>
                                                            </td>
                                                            <td>
                                                                <!-- Tombol Aksi -->
                                                                <div class="d-grid gap-2" style="grid-template-columns: repeat(2, 1fr);">
                                                                    <a href="#" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>
                                                                    <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

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