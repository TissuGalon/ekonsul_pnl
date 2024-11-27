<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$dosen_data = $_SESSION['dosen_data'];
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

<body data-menu-color="light" data-sidebar="default">
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
                                        window.location.href = '<?php echo $status == "success" ? "dosen-permintaan-bimbingan.php" : "dosen-permintaan-bimbingan.php"; ?>';
                                    });
                                });
                            </script>
                            <?php
        }
        ?>
        
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
                    
                    <div class="my-3"></div>
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Kelola Bimbingan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="nav nav-lines mb-0" id="nav1-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav1-home-tab" data-bs-toggle="tab"
                                    href="#nav1-home" aria-selected="true" role="tab">Permintaan Bimbingan</a>
                                    <a class="nav-item nav-link" id="nav1-profile-tab" data-bs-toggle="tab"
                                    href="#nav1-profile" aria-selected="false" role="tab" tabindex="-1">Bimbingan
                                    Selesai</a>
                                    
                                </div>
                            </div>
                            <div class="tab-content" id="nav1-tabContent">
                                <div class="tab-pane fade active show" id="nav1-home" role="tabpanel"
                                aria-labelledby="#nav1-home-tab">
                                <!-- ISI TAB -->
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <div class="card-icon">
                                            <i class="fas fa-edit fs-14 text-muted white"></i>
                                        </div>
                                        <h4 class="card-title mb-0 text-white">Permintaan Bimbingan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tujuan Konseling</th>
                                                        <th>Mahasiswa</th>
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
                                                    $dosen_id = $dosen_data['dosen_id'];
                                                    $color = '';
                                                    $query = mysqli_query($conn, "SELECT * FROM konseling JOIN mahasiswa ON konseling.mahasiswa_id = mahasiswa.mahasiswa_id WHERE status != 'Dibatalkan' AND status != 'Selesai' AND dosen_id = $dosen_id;");
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
                                                                                <?php echo $row['nim'] ?>
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
                                                                                                    <a href="../media/uploads/<?php echo $row['lampiran'] ?>"
                                                                                                        style="display:inline-block;max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
                                                                                                        class="btn btn-sm btn-success"><i
                                                                                                        data-feather="file-text"></i>
                                                                                                        <?php echo $row['lampiran'] ?>
                                                                                                    </a>
                                                                                    <?php } else { ?>
                                                                                                        <a href="#"
                                                                                                        style="display:inline-block;max-width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
                                                                                                        class="btn btn-sm btn-dark"><i
                                                                                                        data-feather="file"></i>
                                                                                                        <?php echo $row['lampiran'] ?> Tidak ada
                                                                                                    </a>
                                                                                    <?php }
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
                                                                                    if ($row['status'] == 'Diajukan') { ?>
                                                                                                        <a href="controller/terima.php?id_konseling=<?php echo $row['id_konseling'] ?>"
                                                                                                            class="btn btn-primary btn-icon">
                                                                                                            <i>Terima</i>
                                                                                                        </a>
                                                                                                        <div class="me-2"></div>
                                                                                                        <a href="controller/jadwal-ulang.php?id_konseling=<?php echo $row['id_konseling'] ?>"
                                                                                                            class="btn btn-warning btn-icon">
                                                                                                            <i>Jadwal Ulang</i>
                                                                                                        </a>
                                                                                        <?php } elseif ($row['status'] == 'Selesai' || $row['status'] == 'Berlangsung' || $row['status'] == 'Diterima') { ?>
                                                                                                            <a href="../chat/chat.php?receiver_id=<?php echo $row['user_id'] ?>"
                                                                                                                class="btn btn-success btn-icon">
                                                                                                                <i>Chat</i>
                                                                                                            </a>
                                                                                                            <div class="me-2"></div>
                                                                                                            <a href="controller/batalkan.php?id_konseling=<?php echo $row['id_konseling'] ?>"
                                                                                                                class="btn btn-danger btn-icon">
                                                                                                                <i>Batalkan</i>
                                                                                                            </a>
                                                                                            <?php } elseif ($row['status'] == 'Jadwal Ulang') { ?>
                                                                                                                <a href="controller/batal-jadwal-ulang.php?id_konseling=<?php echo $row['id_konseling'] ?>"
                                                                                                                    class="btn btn-danger btn-icon">
                                                                                                                    <i>Batalkan Jadwal Ulang</i>
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
                                                        <!-- ISI TAB -->
                                                    </div>
                                                    <div class="tab-pane fade" id="nav1-profile" role="tabpanel"
                                                    aria-labelledby="#nav1-profile-tab">
                                                    <!-- ISI TAB -->
                                                    <div class="card">
                                                        <div class="card-header bg-secondary">
                                                            <div class="card-icon">
                                                                <i class="fas fa-edit fs-14 text-muted white"></i>
                                                            </div>
                                                            <h4 class="card-title mb-0 text-white">Bimbingan Mendatang</h4>
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
                                                                            <th>Waktu</th>
                                                                            <th>Lampiran</th>
                                                                            <th>Status</th>
                                                                            <th>Aksi</th>
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
                                                                            <td><b class="text-primary">Senin,11 November 2024 13:00 -
                                                                                14:00</b>
                                                                            </td>
                                                                            <td>
                                                                                <div class="badge text-bg-primary">Mengunggu</div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="btn btn-sm btn-primary text-truncate"
                                                                                style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                                                <i data-feather="file-text"></i> Lorem ipsum dolor
                                                                                sit amet
                                                                                consectetur, adipisicing elit. Pariatur quod error
                                                                                aspernatur sed recusandae dicta voluptatibus harum,
                                                                                ipsa
                                                                                nostrum omnis, voluptatum dignissimos quas atque
                                                                                explicabo
                                                                                dolor neque tempora, at fugiat?
                                                                            </a>
                                                                            
                                                                        </td>
                                                                        
                                                                        <td class="d-flex">
                                                                            <a href="#!" class="btn btn-secondary btn-icon">
                                                                                <i data-feather="clock"></i>
                                                                                Jadwalkan Ulang
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="10" class="text-center">Tidak ada</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ISI TAB -->
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- start row -->
                                <div class="row">
                                    <div class="col-12">
                                        
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        
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