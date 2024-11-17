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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- CUSTOM -->
    <script src="controller/jurusan-prodi-controller/admin-jurusan-prodi.js"></script>

    
    <div id="app-layout">


        <!-- Topbar Start -->
        <?php include 'component/admin-topbar.php' ?>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <?php include 'component/admin-sidebar.php' ?>
        <!-- Left Sidebar End -->


     <!-- Modal Add Jurusan -->
<div class="modal fade" id="modalJurusan" tabindex="-1" aria-labelledby="modalJurusanTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJurusanTitle">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formJurusan" action="controller/jurusan-prodi-controller/tambah-jurusan.php" method="POST">
                    <input type="hidden" id="jurusan-id" name="jurusan_id">
                    <div class="mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="jurusan_name" placeholder="Masukkan Nama Jurusan" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

<!-- Modal Edit Jurusan -->
<div class="modal fade" id="modalEditJurusan" tabindex="-1" aria-labelledby="modalEditJurusanTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditJurusanTitle">Edit Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formJurusan" action="controller/jurusan-prodi-controller/edit-jurusan.php" method="POST">
                    <input type="hidden" id="edit_jurusan_id" name="edit_jurusan_id">
                    <div class="mb-3">
                        <label for="edit_jurusan_name" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_jurusan_name" name="edit_jurusan_name" placeholder="Masukkan Nama Jurusan" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




  <!-- Modal Add Prodi -->
<div class="modal fade" id="modalProdi" tabindex="-1" aria-labelledby="modalProdiTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdiTitle">Tambah Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formProdi" action="controller/jurusan-prodi-controller/tambah-prodi.php" method="POST">
                    <input type="hidden" id="prodi-id" name="prodi_id">
                    <div class="mb-3">
                        <label for="jurusan_id" class="form-label">Jurusan</label>
                        <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            <?php
                            $queryJurusan = mysqli_query($conn, "SELECT * FROM jurusan");
                            while ($rowJurusan = mysqli_fetch_array($queryJurusan)) {
                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="<?= $rowJurusan['jurusan_id']; ?>"><?= $rowJurusan['jurusan_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="prodi_name" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" id="prodi_name" name="prodi_name" placeholder="Masukkan Nama Prodi" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  


<!-- Modal Edit Prodi -->
<div class="modal fade" id="modalEditProdi" tabindex="-1" aria-labelledby="modalEditProdiLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProdiLabel">Edit Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formProdi" action="controller/jurusan-prodi-controller/edit-prodi.php" method="POST">
                    <input type="hidden" id="edit_prodi_id" name="edit_prodi_id">
                    <div class="mb-3">
                        <label for="edit_jurusan_id" class="form-label">Jurusan (Pilih hanya jika ingin merubah)</label>
                        <select class="form-control" id="edit_jurusan_id" name="edit_jurusan_id">
                            <option value="">Pilih Jurusan</option>
                            <?php
                            $queryeditJurusan = mysqli_query($conn, "SELECT * FROM jurusan");
                            while ($rowJurusan = mysqli_fetch_array($queryeditJurusan)) {
                                ?>
                                                        <option value="<?= $rowJurusan['jurusan_id']; ?>"><?= $rowJurusan['jurusan_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_prodi_name" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" id="edit_prodi_name" name="edit_prodi_name" placeholder="Masukkan Nama Prodi" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content -->
                <div class="container-fluid">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4 class="fs-18 fw-semibold m-0">Data Jurusan & Prodi </h4>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end gap-2 "
                                        style="grid-template-columns: repeat(4, 1fr);">
                                       <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalJurusan"><i class='mdi mdi-plus-box'></i> Tambah Jurusan</button>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProdi"><i class='mdi mdi-plus-box'></i> Tambah Prodi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- start row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        $query = mysqli_query($conn, "SELECT d.jurusan_id, d.jurusan_name, sp.prodi_name, sp.prodi_id FROM jurusan d LEFT JOIN prodi sp ON d.jurusan_id = sp.jurusan_id ORDER BY d.jurusan_id, sp.prodi_name");
                                        ?>
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Jurusan</th>
                                                        <th>Action</th>
                                                        <th>Nama Prodi</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                           <tbody>
    <?php
    if ($query->num_rows > 0) {
        $no = 1;
        $no_prodi = 1;
        $current_jurusan = null;

        while ($row = $query->fetch_assoc()) {
            echo "<tr>";

            // Jika jurusan berubah, tampilkan jurusan baru
            if ($row['jurusan_name'] != $current_jurusan) {
                $no_prodi = 1;
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['jurusan_name']) . "</td>";
                $current_jurusan = $row['jurusan_name'];
                echo "<td><a href='#' onclick='editJurusan(" . $row['jurusan_id'] . ", \"" . addslashes($row['jurusan_name']) . "\")' class='btn btn-sm btn-warning' data-bs-toggle='tooltip' data-bs-title='Edit Jurusan'><i class='mdi mdi-pencil'></i></a>
                <a href='#' onclick='hapusJurusan(" . $row['jurusan_id'] . ")' class='btn btn-sm btn-danger' data-bs-toggle='tooltip' data-bs-title='Hapus Jurusan'><i class='mdi mdi-delete'></i></a></td>";
            } else {
                // Kolom pertama dan kedua kosong untuk prodi tambahan
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
            }

            // Tampilkan program studi
            if ($row['prodi_name'] != null || $row['prodi_name'] != '') {
                echo "<td> " . $no_prodi++ . ") " . htmlspecialchars($row['prodi_name']) . "</td>";
                echo "<td><a href='#' onclick='editProdi(" . $row['prodi_id'] . ", \"" . addslashes($row['prodi_name']) . "\", " . $row['jurusan_id'] . ")' class='btn btn-sm btn-warning' data-bs-toggle='tooltip' data-bs-title='Edit Prodi'><i class='mdi mdi-pencil'></i></a>
                <a href='#' onclick='hapusProdi(" . $row['prodi_id'] . ")' class='btn btn-sm btn-danger' data-bs-toggle='tooltip' data-bs-title='Hapus Prodi'><i class='mdi mdi-delete'></i></a></td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
    }
    ?>
</tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->

            </div> <!-- content -->

            <td>
                
            </td>
            

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