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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css">

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                                <?php
                                                // Query untuk mengambil data dosen dan mahasiswa
                                                $sql = "SELECT d.fullname AS nama_dosen, 
                                                m.fullname AS nama_mahasiswa, 
                                                dm.supervision_type 
                                                FROM dosen_mahasiswa dm
                                                JOIN dosen d ON dm.lecturer_id = d.dosen_id
                                                JOIN mahasiswa m ON dm.student_id = m.mahasiswa_id
                                                ORDER BY d.fullname";

                                                $result = mysqli_query($conn, $sql);

                                                // Array untuk mengelompokkan mahasiswa berdasarkan dosen
                                                $data = [];
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $data[$row['nama_dosen']][] = [
                                                        'nama_mahasiswa' => $row['nama_mahasiswa'],
                                                        'supervision_type' => $row['supervision_type']
                                                    ];
                                                }
                                                ?>


                                                <table id="Table1" class="table table-striped mb-0" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Dosen</th>
                                                            <th>Mahasiswa Bimbingan</th>
                                                            <th>Jenis Bimbingan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($data as $nama_dosen => $mahasiswa_bimbingan) {
                                                            echo "<tr>";
                                                            echo "<td>$no</td>";
                                                            echo "<td>$nama_dosen</td>";
                                                            $mahasiswaList = '';
                                                            foreach ($mahasiswa_bimbingan as $mahasiswa) {
                                                                $mahasiswaList .= $mahasiswa['nama_mahasiswa'] . "<br>";
                                                            }
                                                            echo "<td>$mahasiswaList</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>
                                                                    <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalKelola'
                                                                    data-nama-dosen='$nama_dosen'
                                                                    data-mahasiswa-list='" . json_encode($mahasiswa_bimbingan) . "'>Kelola</button>
                                                                </td>";
                                                            echo "</tr>";
                                                            $no++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <!-- Modal Kelola -->
                                                <div class="modal fade" id="modalKelola" tabindex="-1"
                                                    aria-labelledby="modalKelolaLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalKelolaLabel">Kelola
                                                                    Bimbingan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6 id="dosen_title"></h6>
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Nama Mahasiswa</th>
                                                                            <th>Jenis Bimbingan</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="kelola_tbody"></tbody>
                                                                </table>

                                                                <h6 class="mt-4">Tambahkan Mahasiswa Bimbingan Baru</h6>
                                                                <table class="table table-bordered" id="Table2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Nama Mahasiswa</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="add_tbody">
                                                                        <?php
                                                                        // Ambil daftar mahasiswa yang belum memiliki dosen pembimbing
                                                                        $sql_mahasiswa_lain = "SELECT fullname FROM mahasiswa WHERE mahasiswa_id NOT IN (SELECT student_id FROM dosen_mahasiswa)";
                                                                        $result_mahasiswa_lain = mysqli_query($conn, $sql_mahasiswa_lain);
                                                                        $no_lain = 1;
                                                                        while ($row = mysqli_fetch_assoc($result_mahasiswa_lain)) {
                                                                            echo "<tr class='text-center'>";
                                                                            echo "<td>$no_lain</td>";
                                                                            echo "<td>{$row['fullname']}</td>";
                                                                            echo "<td><button class='btn btn-success btn-sm' onclick='addMahasiswa(\"{$row['fullname']}\")'>Tambahkan</button></td>";
                                                                            echo "</tr>";
                                                                            $no_lain++;
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                               <script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalKelola = document.getElementById('modalKelola');
        modalKelola.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var namaDosen = button.getAttribute('data-nama-dosen');
            var mahasiswaList = JSON.parse(button.getAttribute('data-mahasiswa-list'));

            document.getElementById('dosen_title').innerText = `Dosen: ${namaDosen}`;
            
            var tbodyContent = '';
            mahasiswaList.forEach(function (item, index) {
                tbodyContent += `<tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_mahasiswa}</td>
                    <td>${item.supervision_type}</td>
                    <td>
                        <a href="edit.php?id=${index}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(${index}, '${item.nama_mahasiswa}')">Delete</button>
                    </td>
                </tr>`;
            });

            document.getElementById('kelola_tbody').innerHTML = tbodyContent;
        });

        window.addMahasiswa = function (namaMahasiswa) {
            Swal.fire({
                title: 'Konfirmasi Tambah Mahasiswa',
                text: `Apakah Anda yakin ingin menambahkan ${namaMahasiswa} sebagai mahasiswa bimbingan?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambahkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proses penambahan mahasiswa di backend
                    Swal.fire('Berhasil!', `Mahasiswa ${namaMahasiswa} telah ditambahkan.`, 'success');
                }
            });
        }

        window.confirmDelete = function (id, namaMahasiswa) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${namaMahasiswa} dari daftar bimbingan?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke halaman delete
                    window.location.href = `delete.php?id=${id}`;
                }
            });
        }
    });
</script>






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
                                                                            <img src="../assets/images/users/user-12.jpg"
                                                                                class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg"
                                                                                class="avatar avatar-sm rounded-circle me-2">
                                                                            <p class="mb-0">Jenny Wilson</p>
                                                                        </div>
                                                                        <div class="d-flex align-items-center m-2">
                                                                            <img src="../assets/images/users/user-12.jpg"
                                                                                class="avatar avatar-sm rounded-circle me-2">
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
                                                                <div class="d-grid gap-2"
                                                                    style="grid-template-columns: repeat(2, 1fr);">
                                                                    <a href="#" class="btn btn-sm btn-warning"><i
                                                                            class="mdi mdi-pencil"></i></a>
                                                                    <a href="#" class="btn btn-sm btn-danger"><i
                                                                            class="mdi mdi-delete"></i></a>
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

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#Table1');
        let table2 = new DataTable('#Table2');
        let table3 = new DataTable('#Table3');
    </script>

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