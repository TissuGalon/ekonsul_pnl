<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

if (isset($_SESSION['mahasiswa_data'])) {
	$data = $_SESSION['mahasiswa_data'];
	$sender_id = $data['user_id'];
} elseif (isset($_SESSION['dosen_data'])) {
	$data = $_SESSION['dosen_data'];
	$sender_id = $data['user_id'];
} else {
	header('location: ../index.php');
}

$receiver_id = $_GET['receiver_id'];
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
	
	
	<style>
		.chat-box {
			height: 400px;
			overflow-y: auto;
			background-color: #f8f9fa;
			border-radius: 10px;
			padding: 10px;
		}
		
		.chat-bubble {
			padding: 10px;
			border-radius: 10px;
			margin-bottom: 8px;
			max-width: 70%;
		}
		
		.chat-bubble.sender {
			background-color: #007bff;
			color: #fff;
			margin-left: auto;
		}
		
		.chat-bubble.receiver {
			background-color: #e9ecef;
			color: #000;
			margin-right: auto;
		}
		
		.chat-header {
			font-weight: bold;
			color: #fff;
			background-color: #343a40;
			padding: 10px;
			border-radius: 10px 10px 0 0;
		}
	</style>
	
</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">
	<div id="app-layout">
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
		
		
		
		<!-- Topbar Start -->
		<?php
		if (isset($_SESSION['mahasiswa_data'])) {
			include '../mahasiswa/mahasiswa-topbar.php';
		} else if (isset($_SESSION['dosen_data'])) {
			include '../dosen/dosen-topbar.php';
		}
		?>
		<!-- end Topbar -->
		
		<!-- Left Sidebar Start -->
		<div class="app-sidebar-menu">
			<div class="h-100" data-simplebar>
				
				<!--- Sidemenu -->
				<?php
				if (isset($_SESSION['mahasiswa_data'])) {
					include 'component/mahasiswa-sidebar.php';
				} else if (isset($_SESSION['dosen_data'])) {
					include 'component/dosen-sidebar.php';
				}
				?>
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
				<div class="container-fluid mt-3 rounded">
					<!-- start row -->
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header bg-primary rounded">
									<div class="d-flex justify-content-between">
										<div class="d-flex">
											<button  onclick="history.back()" class="btn btn-secondary"><i data-feather="arrow-left"></i></button>
										</div>
										<div class="d-flex">
											<i data-feather="mail" class="text-white me-2"></i>
											<h4 class=" m-0 p-0 text-white ">CHAT</h4>
										</div>
										<div class="d-flex">
											<a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
											role="button" aria-haspopup="false" aria-expanded="false">
											<img src="../assets/images/users/man.png" alt="user-image" class="rounded-circle">
											<span class="pro-user-name ms-1 text-white">
												Student
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="chat-box" id="chat-box">
								<!-- Chat messages will be dynamically loaded here -->
							</div>
							<div class="card-body">
								<form id="chat-form" enctype="multipart/form-data">
									<div class="input-group">
										<input type="text" name="message" id="message" class="form-control"
										placeholder="Type your message">
										<input type="file" name="document" id="document" class="form-control"
										style="max-width: 150px;">
										<button type="submit" class="btn btn-primary"><i data-feather="send"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			</div> <!-- container-fluid -->
		</div> <!-- content -->
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			$(document).ready(function () {
				const senderId = <?php echo $sender_id; ?>; 
				const receiverId = <?php echo $receiver_id; ?>;
				
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
				setInterval(loadMessages, 2000); 
			});
		</script>
		
		

		
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



<!-- Widgets Init Js -->
<script src="../assets/js/pages/crm-dashboard.init.js"></script>

<!-- App js-->
<script src="../assets/js/app.js"></script>

</body>

</html>