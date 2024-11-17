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

    <style>
        .custom-scroll {
            overflow-x: scroll;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .custom-scroll::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, and Opera */
        }
    </style>
</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default" <!-- Begin page -->
    <div id="app-layout">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- ---- MODAL TAMBAH ---- -->
        <div class="modal fade" id="modalDosen" tabindex="-1" aria-labelledby="modalDosenLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDosenLabel">Tambah Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formDosen" action="controller/data-dosen-controller/add-dosen.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="row g-3">
                                <!-- Upload Foto -->
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="add-foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="add-foto" name="add-foto"
                                            accept=".jpg,.jpeg,.png" required>
                                    </div>
                                </div><!--end col-->

                                <!-- Nama Lengkap -->
                                <div class="col-xxl-4">
                                    <div>
                                        <label for="add-fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="add-fullname" name="add-fullname"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div><!--end col-->

                                <!-- NIP -->
                                <div class="col-xxl-4">
                                    <div>
                                        <label for="add-nip" class="form-label">NIP</label>
                                        <input type="number" class="form-control" id="add-nip" name="add-nip"
                                            placeholder="Masukkan NIP" required>
                                    </div>
                                </div><!--end col-->

                                <!-- Password -->
                                <div class="col-xxl-4">
                                    <div>
                                        <label for="add-password" class="form-label">Password (Sama dengan NIP)</label>
                                        <input type="password" class="form-control" id="add-password"
                                            name="add-password" placeholder="Masukkan password" required readonly>
                                    </div>
                                </div><!--end col-->

                                <!-- Submit dan Close -->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- ---- MODAL TAMBAH ---- -->




        <!-- ---- MODAL EDIT ---- -->
       <div class="modal fade" id="modalEditDosen" tabindex="-1" aria-labelledby="modalEditDosenLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditDosenLabel">Edit Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <form id="formDosen" action="controller/data-dosen-controller/edit-dosen.php" method="POST" enctype="multipart/form-data">
    <div class="row g-3">
        <!-- Input Hidden untuk ID User -->
        <input type="hidden" name="edit_user_id" id="edit_user_id">
        
        <!-- Upload Foto -->
        <div class="col-xxl-12">
            <div>
                <label for="edit-foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="edit-foto" name="edit-foto" accept=".jpg,.jpeg,.png">
            </div>
        </div><!--end col-->

        <!-- Nama Lengkap -->
        <div class="col-xxl-6">
            <div>
                <label for="edit-fullname" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="edit-fullname" name="edit-fullname" placeholder="Masukkan nama lengkap" required>
            </div>
        </div><!--end col-->

        <!-- NIP -->
        <div class="col-xxl-6">
            <div>
                <label for="edit-nip" class="form-label">NIP</label>
                <input type="number" class="form-control" id="edit-nip" name="edit-nip" placeholder="Masukkan NIP" required>
            </div>
        </div><!--end col-->
  
        <!-- Submit dan Close -->
        <div class="col-lg-12">
            <div class="hstack gap-2 justify-content-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</form>


                    </div>
                </div>
            </div>
        </div>

        <!-- ---- MODAL EDIT ---- -->




        <!-- ---- MODAL GANTI PASSWORD ---- -->
        <div class="modal fade" id="modalGantiPassword" tabindex="-1" aria-labelledby="modalGantiPasswordLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalGantiPasswordLabel">Ganti Password Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formGantiPassword" action="controller/data-dosen-controller/edit-pass-dosen.php" method="POST">
                            <input type="hidden" id="gantipass-userId" name="gantipass-userId">
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <label for="newPassword" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        placeholder="Masukkan Password Baru" required>
                                </div>
                                <div class="col-xxl-12">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                        placeholder="Masukkan Kembali Password" required>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---- MODAL GANTI PASSWORD ---- -->




        <!-- ---- MODAL FOTO MAHASISWA ---- -->
        <div class="modal fade" id="modalFotoDosen" tabindex="-1" aria-labelledby="modalFotoDosenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFotoDosenLabel">Foto Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="foto-dosen" class="img-fluid rounded" src="" alt="Foto Dosen"
                            style="max-height: 300px;">
                        <h6 id="nama-dosen" class="mt-3"></h6>
                        <p id="nip-dosen"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---- MODAL FOTO MAHASISWA ---- -->





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


                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex gap-2 custom-scroll">
                                        <div class="" data-bs-toggle="tooltip" data-bs-title="Tambah Data Dosen">
                                            <button type="button" id="btnTambah" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modalDosen"><i
                                                    class="mdi mdi-plus-box"></i> Tambah
                                                Dosen</button>
                                        </div>
                                        <!--   <div class="" data-bs-toggle="tooltip"
                                            data-bs-title="Tambah Data Dosen Secara Massal">
                                            <a href="#" class="btn btn-warning"><i
                                                    class="mdi mdi-plus-box-multiple"></i> Tambah Bulk Data</a>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- start row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Foto</th>
                                                        <th>NIP</th>
                                                        <th>Nama</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT dosen.*, users.* FROM dosen JOIN users ON dosen.user_id = users.user_id  WHERE dosen.deleted_at IS NULL AND users.deleted_at IS NULL;");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                                                                                                    <tr>
                                                                                                                                        <td>
                                                                                                                                            <?php echo $no++; ?>
                                                                                                                                        </td>
                                                                                                                                        <td>
                                                                                                                                            <div class="flex-shrink-0 align-self-center foto-dosen"
                                                                                                                                                style="cursor: pointer;">
                                                                                                                                                <div class="align-content-center text-center border border-dashed rounded-circle p-1 foto-dosen"
                                                                                                                                                    style="width: 50px; height: 50px;"
                                                                                                                                                    data-url="../media/<?php echo htmlspecialchars($row['profile_photo']); ?>"
                                                                                                                                                    data-fullname="<?php echo htmlspecialchars($row['fullname']); ?>"
                                                                                                                                                    data-nip="<?php echo htmlspecialchars($row['nip']); ?>"
                                                                                                                                                    data-bs-toggle="modal" data-bs-target="#modalFotoDosen">
                                                                                                                                                    <img src="../media/<?php echo htmlspecialchars($row['profile_photo']); ?>"
                                                                                                                                                        onerror="this.onerror=null; this.src='../media/blank_profile.png';"
                                                                                                                                                        class="avatar avatar-sm rounded-circle"
                                                                                                                                                        style="width: 100%; height: 100%; object-fit: cover;"
                                                                                                                                                        alt="Foto Dosen">
                                                                                                                                                </div>


                                                                                                                                            </div>
                                                                                                                                        </td>

                                                                                                                                        <td>
                                                                                                                                            <?php echo $row['nip']; ?>
                                                                                                                                        </td>
                                                                                                                                        <td>
                                                                                                                                            <?php echo $row['fullname']; ?>
                                                                                                                                        </td>

                                                                                                                                        <td>
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="d-grid gap-2"
                                                                                                                                                    style="grid-template-columns: repeat(2, 1fr);">
                                                                                                                                                    <button
                                                                                                                                                    onclick="editDosen('<?php echo $row['user_id']; ?>', '<?php echo $row['nip']; ?>', '<?php echo $row['fullname']; ?>')"
                                                                                                                                                        data-bs-toggle="tooltip"
                                                                                                                                                        data-bs-title="Edit Data Dosen"
                                                                                                                                                        class="btn btn-sm btn-warning btn-edit-dosen">
                                                                                                                                                        <i class="mdi mdi-pencil"></i>
                                                                                                                                                    </button>

                                                                                                                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                                                                                                        data-bs-title="Hapus Data Dosen"
                                                                                                                                                        onclick="deleteDosen('<?php echo $row['user_id']; ?>')"
                                                                                                                                                        class="btn btn-sm btn-danger btn-delete"
                                                                                                                                                        data-id="<?php echo $row['user_id']; ?>">
                                                                                                                                                        <i class="mdi mdi-delete"></i>
                                                                                                                                                    </a>

                                                                                                                                                    <button class="btn btn-sm btn-info btn-edit-password"
                                                                                                                                                    onclick="editPassDosen('<?php echo $row['user_id']; ?>')"
                                                                                                                                                        data-bs-toggle="tooltip"
                                                                                                                                                        data-bs-title="Ganti Password Dosen"
                                                                                                                                                        data-user-id="<?php echo $row['user_id']; ?>"><i
                                                                                                                                                            class="mdi mdi-key"></i></button>
                                                                                                                                                </div>
                                                                                                                                            </div>
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


    <!-- CUSTOM -->
    <script src="controller/data-dosen-controller/admin-data-dosen.js"></script>

</body>

</html>