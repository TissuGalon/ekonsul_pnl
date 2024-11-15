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
        <div class="modal fade" id="modalMahasiswa" tabindex="-1" aria-labelledby="modalMahasiswaLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMahasiswaLabel">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formMahasiswa" action="javascript:void(0);">
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="fotoInput" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="fotoInput">
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <label for="nimInput" class="form-label">NIM</label>
                                    <input type="number" class="form-control" id="nimInput" placeholder="Masukkan NIM"
                                        required>
                                </div><!--end col-->

                                <div class="col-xxl-4">
                                    <label for="passwordInput" class="form-label">Password (Sama dengan NIM)</label>
                                    <input type="password" class="form-control" id="passwordInput"
                                        placeholder="Masukkan password" required readonly>
                                </div><!--end col-->

                                <hr>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="jurusanSelect" class="form-label">Jurusan</label>
                                        <select class="form-control" id="jurusanSelect" required>
                                            <option value="">Pilih Jurusan</option>
                                            <?php
                                            $queryJurusan = mysqli_query($conn, "SELECT * FROM departments");
                                            while ($rowjurusan = mysqli_fetch_array($queryJurusan)) {
                                                echo "<option value='" . $rowjurusan['department_id'] . "' data-id='" . $rowjurusan['department_id'] . "'>" . $rowjurusan['department_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="prodiSelect" class="form-label">Prodi</label>
                                        <select class="form-control" id="prodiSelect" required>
                                            <option value="">Pilih Prodi</option>
                                            <?php
                                            $queryProdi = mysqli_query($conn, "SELECT * FROM study_programs");
                                            while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                                                echo "<option value='" . $rowProdi['program_id'] . "' data-id='" . $rowProdi['department_id'] . "'>" . $rowProdi['program_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="semesterInput" class="form-label">Semester</label>
                                        <input type="number" class="form-control" id="semesterInput"
                                            placeholder="Masukkan semester" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---- MODAL TAMBAH ---- -->




        <!-- ---- MODAL EDIT ---- -->
        <div class="modal fade" id="modalEditMahasiswa" tabindex="-1" aria-labelledby="modalEditMahasiswaLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditMahasiswaLabel">Edit Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditMahasiswa" action="javascript:void(0);">
                            <div class="row g-3">
                                <!-- Hidden Field untuk ID Mahasiswa -->
                                <input type="hidden" id="edit-user_id">
                                <input type="hidden" id="edit-mahasiswaId">

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="edit-fotoInput" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="edit-fotoInput">
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="edit-namaLengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="edit-namaLengkap"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <label for="edit-nimInput" class="form-label">NIM</label>
                                    <input type="number" class="form-control" id="edit-nimInput"
                                        placeholder="Masukkan NIM" required>
                                </div><!--end col-->

                       

                                <hr>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="edit-jurusanSelect" class="form-label">Jurusan</label>
                                        <select class="form-control" id="edit-jurusanSelect" required>
                                            <option value="">Pilih Jurusan</option>
                                            <?php
                                            $queryJurusan = mysqli_query($conn, "SELECT * FROM departments");
                                            while ($rowjurusan = mysqli_fetch_array($queryJurusan)) {
                                                echo "<option value='" . $rowjurusan['department_id'] . "'>" . $rowjurusan['department_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="edit-prodiSelect" class="form-label">Prodi</label>
                                        <select class="form-control" id="edit-prodiSelect" required>
                                            <option value="">Pilih Prodi</option>
                                            <?php
                                            $queryProdi = mysqli_query($conn, "SELECT * FROM study_programs");
                                            while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                                                echo "<option value='" . $rowProdi['program_id'] . "'>" . $rowProdi['program_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xxl-4">
                                    <div>
                                        <label for="edit-semesterInput" class="form-label">Semester</label>
                                        <input type="number" class="form-control" id="edit-semesterInput"
                                            placeholder="Masukkan semester" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- ---- MODAL EDIT ---- -->




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
                                        <div class="">
                                            <button type="button" id="btnTambah" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modalMahasiswa">Tambah
                                                Mahasiswa</button>
                                        </div>
                                        <div class="">
                                            <a href="#" class="btn btn-success"><i
                                                    class="mdi mdi-plus-box-multiple"></i> Tambah Bulk Data</a>
                                        </div>

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
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Jurusan</th>
                                                        <th>Prodi</th>
                                                        <th>Semester</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT mahasiswa.*, users.*, study_programs.*, departments.* FROM mahasiswa JOIN users ON mahasiswa.user_id = users.user_id JOIN study_programs ON mahasiswa.program_id = study_programs.program_id JOIN departments ON study_programs.department_id = departments.department_id WHERE mahasiswa.deleted_at IS NULL AND users.deleted_at IS NULL;");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?php echo $no++; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="flex-shrink-0 align-self-center"
                                                                                        style="cursor: pointer;">
                                                                                        <div class="align-content-center text-center border border-dashed rounded-circle p-1"
                                                                                            style="width: 50px; height: 50px;">
                                                                                            <img src="../media/<?php echo $row['profile_photo']; ?>"
                                                                                                onerror="this.onerror=null; this.src='../media/blank_profile.png';"
                                                                                                class="avatar avatar-sm rounded-circle"
                                                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <?php echo $row['nim']; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $row['fullname']; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $row['department_name']; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $row['program_name']; ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $row['semester']; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="row">
                                                                                        <div class="d-grid gap-2"
                                                                                            style="grid-template-columns: repeat(2, 1fr);">
                                                                                            <button id="btn-edit-<?php echo $row['student_id']; ?>"
                                                                                                class="btn btn-sm btn-warning btn-edit-mahasiswa"
                                                                                                data-user_id="<?php echo $row['user_id']; ?>"
                                                                                                data-id="<?php echo $row['student_id']; ?>"
                                                                                                data-nama="<?php echo $row['fullname']; ?>"
                                                                                                data-nim="<?php echo $row['nim']; ?>"
                                                                                                data-jurusan="<?php echo $row['department_id']; ?>"
                                                                                                data-prodi="<?php echo $row['program_id']; ?>"
                                                                                                data-semester="<?php echo $row['semester']; ?>"
                                                                                                data-foto="<?php echo $row['profile_photo']; ?>">
                                                                                                Edit
                                                                                            </button>

                                                                                           <a href="javascript:void(0);" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $row['user_id']; ?>">
            <i class="mdi mdi-delete"></i> Hapus
        </a>

                                                                                            <a href="#" class="btn btn-sm btn-info">
                                                                                                <i class="mdi mdi-key-variant"></i>
                                                                                            </a>
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
    <script src="controller/admin-data-mahasiswa.js"></script>

</body>

</html>