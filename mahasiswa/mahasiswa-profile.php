<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$mahasiswa_data = $_SESSION['mahasiswa_data'];
$user_id = $mahasiswa_data['user_id'];
$query = mysqli_query($conn, "SELECT mahasiswa.*, users.*, prodi.*, jurusan.* FROM mahasiswa JOIN users ON mahasiswa.user_id = users.user_id LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.prodi_id LEFT JOIN jurusan ON prodi.jurusan_id = jurusan.jurusan_id WHERE mahasiswa.deleted_at IS NULL AND users.deleted_at IS NULL AND users.user_id = $user_id;");
$datauser = [];
if($query){
    $datauser = mysqli_fetch_assoc($query);
}

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
                            <h4 class="fs-18 fw-semibold m-0">Profile Mahasiswa</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                                <li class="breadcrumb-item active">Profile Mahasiswa</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="align-items-center">

                                        <div class="silva-main-sections">
                                            <div class="silva-profile-main">
                                                <img src="../media/<?php echo $datauser['profile_photo']; ?>" class="rounded-circle img-fluid avatar-xxl img-thumbnail float-start"  alt="image profile"onerror="this.onerror=null;this.src='../media/blank_profile.jpg';">
                                                <span class="sil-profile_main-pic-change img-thumbnail">
                                                    <i class="mdi mdi-camera text-white"></i>
                                                </span>
                                            </div>

                                            <div class="overflow-hidden ms-md-4 ms-0">
                                                <h4 class="m-0 text-primary fs-20 mt-2 mt-md-0"><b><?php echo $datauser['fullname']; ?></b>
                                                </h4>
                                                <p class="my-1 text-muted fs-16"><?php echo $datauser['nim']; ?></p>
                                                <span class="fs-15"><i
                                                        class="mdi mdi-school me-2 align-middle"></i><?php echo $datauser['jurusan_name']; ?> - <?php echo $datauser['prodi_name']; ?></span>

                                                <hr>
                                                <p>Dosen Pembimbing :</p>
                                                <span class="fs-15 text-primary"><i data-feather="user"
                                                        class="me-2"></i>Reza
                                                    Zulman</span>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Data Mahasiswa -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab"
                                                href="#profile_about" role="tab">
                                                <span class="d-block d-sm-none"><i
                                                        class="mdi mdi-information"></i></span>
                                                <span class="d-none d-sm-block">Data Mahasiswa</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content text-muted bg-white">
                                        <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <div class="card border">

                                                        <div class="card-header">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <h4 class="card-title mb-0">Data Mahasiswa
                                                                    </h4>
                                                                </div><!--end col-->
                                                            </div>
                                                        </div>

                                                        <div class="card-body">    
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        value="<?php echo $datauser['fullname'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">NIM</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text"
                                                                        value="<?php echo $datauser['nim'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">Jurusan</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text" value="<?php echo $datauser['jurusan_name'] ?>"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3 row">
                                                                <label class="form-label">Prodi</label>
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <input class="form-control" type="text" value="<?php echo $datauser['prodi_name'] ?>"
                                                                        readonly>
                                                                </div>
                                                            </div>
                        


                                                        </div><!--end card-body-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end Profile Data -->
                                    </div> <!-- Tab panes -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content -->

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

    <!-- App js-->
    <script src="../assets/js/app.js"></script>

</body>

</html>