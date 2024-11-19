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
		<!-- Topbar Start -->
		<div class="topbar-custom">
			<div class="container-fluid">
				<div class="d-flex justify-content-between">
					<ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
						<li>
							<button class="button-toggle-menu nav-link">
								<i data-feather="menu" class="noti-icon"></i>
							</button>
						</li>
						<li class="d-none d-lg-block">
							<h5 class="mb-0">Good Morning</h5>
						</li>
					</ul>

					<ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">



						<li class="d-none d-sm-flex">
							<button type="button" class="btn nav-link" data-toggle="fullscreen">
								<i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
							</button>
						</li>



						<li class="dropdown notification-list topbar-dropdown">
							<a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
							role="button" aria-haspopup="false" aria-expanded="false">
							<img src="../assets/images/users/man.png" alt="user-image" class="rounded-circle">
							<span class="pro-user-name ms-1">
								Student <i class="mdi mdi-chevron-down"></i>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end profile-dropdown ">
							<!-- item-->
							<div class="dropdown-header noti-title">
								<h6 class="text-overflow m-0">Welcome !</h6>
							</div>

							<!-- item-->
							<a href="mahasiswa-profile.php" class="dropdown-item notify-item">
								<i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
								<span>Profil Saya</span>
							</a>


							<div class="dropdown-divider"></div>

							<!-- item-->
							<a href="../auth/logout.php" class="dropdown-item notify-item">
								<i class="mdi mdi-location-exit fs-16 align-middle"></i>
								<span>Logout</span>
							</a>

						</div>
					</li>

				</ul>
			</div>

		</div>

	</div>
	<!-- end Topbar -->

	<!-- Left Sidebar Start -->
	<div class="app-sidebar-menu">
		<div class="h-100" data-simplebar>

			<!--- Sidemenu -->
			<div id="sidebar-menu">

				<div class="logo-box">
					<a href="index.php" class="logo logo-light">
						<span class="logo-sm">
							<img src="assets/images/logo-sm.png" alt="" height="22">
						</span>
						<span class="logo-lg">
							<img src="assets/images/logo-light.png" alt="" height="24">
						</span>
					</a>
					<a href="index.php" class="logo logo-dark">
						<span class="logo-sm">
							<img src="assets/images/logo-sm.png" alt="" height="22">
						</span>
						<span class="logo-lg">
							<img src="assets/images/logo-dark.png" alt="" height="24">
						</span>
					</a>
				</div>

				<ul id="side-menu">

					<li class="menu-title">Menu</li>

					<li>
						<a href="mahasiswa-beranda.php" class="tp-link btn btn-primary text-white">
							<i data-feather="arrow-left"></i>
							<span> Kembali </span>
						</a>
					</li>



				</ul>


			</div>
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
						<h4 class="fs-18 fw-semibold m-0">Chat Pages</h4>
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
								<h5 class="card-title">Chat Room</h5>
								<div class="container ">
								
									<div class="chat-box border p-3 my-3" style="height: 300px; overflow-y: scroll;" id="chat-box">
										<!-- Chat messages will be dynamically loaded here -->
									</div>
									<form id="chat-form" enctype="multipart/form-data">
										<div class="input-group mb-2">
											<input type="text" name="message" id="message" class="form-control" placeholder="Type your message">
											<input type="file" name="document" id="document" class="form-control">
										</div>
										<button type="submit" class="btn btn-primary w-100">Send</button>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div> <!-- container-fluid -->
		</div> <!-- content -->


		<script>
			$(document).ready(function () {
        const senderId = <?php echo $mahasiswa_data['user_id']; ?>; // Mahasiswa yang sedang login
        let receiverId = <?php echo $_GET['receiver_id']; ?>;

        function loadMessages() {
        	$.get('load_messages.php', {sender_id: senderId, receiver_id: receiverId}, function (data) {
        		$('#chat-box').html(data);
        		$('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        	});
        }

        $('#chat-form').on('submit', function (e) {
        	e.preventDefault();
        	const formData = new FormData(this);
        	formData.append('sender_id', senderId);
        	formData.append('receiver_id', receiverId);

        	$.ajax({
        		url: 'save_message.php',
        		type: 'POST',
        		data: formData,
        		contentType: false,
        		processData: false,
        		success: function () {
        			$('#message').val('');
        			$('#document').val('');
        			loadMessages();
        		}
        	});
        });

        loadMessages();
        setInterval(loadMessages, 2000); // Refresh every 2 seconds
    });
</script>


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