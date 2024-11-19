<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Page"/>
    <meta name="author" content="Zoyothemes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    
    <!-- App css -->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <style>
             .bglogin {
                background: hsla(350, 100%, 57%, 1);

                background: radial-gradient(circle, hsla(350, 100%, 57%, 1) 0%, hsla(346, 100%, 27%, 1) 100%);

                background: -moz-radial-gradient(circle, hsla(350, 100%, 57%, 1) 0%, hsla(346, 100%, 27%, 1) 100%);

                background: -webkit-radial-gradient(circle, hsla(350, 100%, 57%, 1) 0%, hsla(346, 100%, 27%, 1) 100%);

                filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#FF2348", endColorstr="#8C0021", GradientType=1 );
                        }
        </style>
</head>

<body class="bglogin">
    <?php
    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: index.php");
        exit;
    }

    // Tampilkan pesan dari session jika ada
    if (isset($_SESSION['error_message'])) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{$_SESSION['error_message']}',
        });
        </script>";
        unset($_SESSION['error_message']);
    }

    if (isset($_SESSION['success_message'])) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{$_SESSION['success_message']}',
        });
        </script>";
        unset($_SESSION['success_message']);
    }
    ?>

    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center justify-content-center g-0">
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card p-3 mb-0">
                                <div class="card-body">
                                    <div class="mb-4 p-0 text-center">
                                        <a href="index.php" class="auth-logo">
                                            <img src="../assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
                                        </a>
                                    </div>
                                    <div class="auth-title-section mb-3 text-center">
                                        <h3 class="text-dark fs-20 fw-medium mb-2">Welcome back</h3>
                                        <p class="text-dark text-capitalize fs-14 mb-0">Sign in to continue.</p>
                                    </div>
                                    
                                    <form action="Auth.php" method="POST" class="my-4">
                                        <input type="hidden" name="action" value="login">
                                        <div class="form-group mb-3">
                                            <label for="id" class="form-label">Login ID</label>
                                            <input type="text" class="form-control" required name="id" placeholder="Enter Login ID">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" required name="password" placeholder="Enter password">
                                        </div>
                                        
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit">Log In</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- <div class="text-center text-muted mb-4">
                                        <p class="mb-0">Don't have an account? <a class='text-primary ms-2 fw-medium' href='register.php'>Sign up</a></p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="col-xl-7">
                    <div class="account-page-bg p-md-5 p-4">
                        <div class="text-center">
                            <div class="auth-image">
                                <img src="../assets/images/auth-images.svg" class="mx-auto img-fluid" alt="images">
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
    
    <!-- Vendor scripts -->
    <script src="../assets/libs/jquery/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="../assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
