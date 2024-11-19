<?php 
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$mahasiswa_data = $_SESSION['mahasiswa_data'];
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

<body data-menu-color="light" data-sidebar="default" >
    <div id="app-layout">

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


     <?php
     if (isset($_GET['status']) && isset($_GET['message'])) {
        $status = $_GET['status'];
        $message = urldecode($_GET['message']);
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: '<?php echo $status == "success" ? "success" : "error"; ?>',
                    title: '<?php echo $status == "success" ? "Berhasil!" : "Gagal!"; ?>',
                    text: '<?php echo $message; ?>',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = '<?php echo $status == "success" ? "mahasiswa-data-konseling.php" : "mahasiswa-data-konseling.php"; ?>';
                });
            });
        </script>
        <?php
    }
    ?>

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
                                                <th>Dosen</th>
                                                <th>Jenis Konseling</th>
                                                <th>Waktu Konseling</th>
                                                <th>Lampiran</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $mahasiswa_id = $mahasiswa_data['mahasiswa_id'];
                                            $color = '';
                                            $query = mysqli_query($conn, "SELECT * FROM konseling JOIN dosen ON konseling.dosen_id = dosen.dosen_id WHERE status != 'Dibatalkan' AND mahasiswa_id = $mahasiswa_id;");
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $no++; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $row['tujuan_konseling'] ?>
                                                    </td>
                                                    <td>
                                                        <b class="text-primary">
                                                            <?php echo $row['fullname'] ?>
                                                        </b>
                                                        <br>
                                                        <?php echo $row['nip'] ?>                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo $row['jenis_konseling'] ?>
                                                    </td>
                                                    <td>
                                                        <b>
                                                            <?php echo $row['tanggal_konseling'] ?>
                                                        </b>
                                                        <br>
                                                        <?php echo $row['waktu_mulai'] ?> -
                                                        <?php echo $row['waktu_selesai'] ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if ($row['lampiran'] != null || $row['lampiran'] != '') { ?>
                                                            <a href="../media/uploads/<?php echo $row['lampiran'] ?>" style="display:inline-block;max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="btn btn-sm btn-success"><i data-feather="file-text"></i> <?php echo $row['lampiran'] ?></a>
                                                        <?php  }else{ ?>
                                                            <a href="#" style="display:inline-block;max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="btn btn-sm btn-dark"><i data-feather="file"></i> <?php echo $row['lampiran'] ?> Tidak ada</a>
                                                        <?php  }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php 
                                                        switch ($row['status']) {
                                                            case 'Diajukan':
                                                            $color = 'primary';
                                                            break;
                                                            case 'Diterima':
                                                            $color = 'success';
                                                            break;
                                                            case 'Jadwal Ulang':
                                                            $color = 'warning';
                                                            break;
                                                            case 'Ditolak':
                                                            $color = 'danger';
                                                            break;
                                                            case 'Selesai':
                                                            $color = 'success';
                                                            break;
                                                            default:
                                                            $color = 'primary';
                                                            break;
                                                        }
                                                        ?>
                                                        <div class="badge text-bg-<?php echo $color; ?>">
                                                            <?php echo $row['status'] ?>
                                                        </div>
                                                    </td>
                                                    <td class="d-flex" style="padding: 15px;">
                                                        <?php 
                                                        if ($row['status'] == 'Diajukan' || $row['status'] == 'Jadwal Ulang') { ?>
                                                            <a href="controller/batalkan-konseling.php?id_konseling=<?php echo $row['id_konseling']?>" class="btn btn-danger btn-icon">
                                                                <i>Batalkan</i>
                                                            </a>
                                                        <?php } elseif ($row['status'] == 'Selesai' || $row['status'] == 'Berlangsung' || $row['status'] == 'Diterima') { ?>
                                                            <a href="../chat/chat.php?receiver_id=<?php echo $row['user_id'] ?>" class="btn btn-success btn-icon">
                                                                <i>Chat</i>
                                                            </a>
                                                        <?php } else { ?>
                                                           <a href="#" class="btn btn-success disabled btn-icon">
                                                                <i>Chat</i>
                                                            </a>
                                                        <?php } ?>
                                                    </td>




                                                </tr>
                                            <?php } ?>

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