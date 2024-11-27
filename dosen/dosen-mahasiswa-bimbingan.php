<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$dosen_data = $_SESSION['dosen_data'];
$user_id = $dosen_data['user_id'];

?>


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
                            <h4 class="fs-18 fw-semibold m-0">Bimbingan</h4>
                        </div>
                    </div>

                    <?php
                    $no = 1;
                    $dosen_id = $dosen_data['dosen_id'];
                    $query = mysqli_query($conn, "SELECT 
                                                        dosen_mahasiswa.*,
                                                        mahasiswa.*,
                                                        prodi.prodi_name AS prodi_nama,
                                                        jurusan.jurusan_name AS jurusan_nama
                                                        FROM 
                                                        dosen_mahasiswa
                                                        JOIN 
                                                        mahasiswa ON dosen_mahasiswa.student_id = mahasiswa.mahasiswa_id
                                                        JOIN 
                                                        prodi ON mahasiswa.prodi_id = prodi.prodi_id
                                                        JOIN 
                                                        jurusan ON prodi.jurusan_id = jurusan.jurusan_id
                                                        WHERE 
                                                        dosen_mahasiswa.lecturer_id = $dosen_id;
                                                        ");
                    $jumlah = mysqli_num_rows($query);
                    ?>

                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="card mb-0">
                                        <div class="card-header bg-primary">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div class="d-flex align-items-center">
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
                                        <p class="mb-0 text-white fs-15">Total Mahasiswa Bimbingan</p>
                                    </div>
                                    <h3 class="mb-0 fs-22 text-white me-3"><?php echo $jumlah; ?></h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="widget-first">





                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Jurusan</th>
                                                        <th>Prodi</th>
                                                        <th>Semester</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    <?php

                                                    while ($row = mysqli_fetch_array($query)) { ?>
                                                                                    <tr>
                                                                                        <td><?php echo $no++; ?></td>
                                                                                        <td><?php echo $row['fullname'] ?></td>
                                                                                        <td><?php echo $row['nim'] ?></td>
                                                                                        <td><?php echo $row['jurusan_nama'] ?></td>
                                                                                        <td><?php echo $row['prodi_nama'] ?></td>
                                                                                        <td><?php echo $row['semester'] ?></td>
                                                                                    </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
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