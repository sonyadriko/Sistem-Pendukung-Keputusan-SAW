<?php 
    include 'proses_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../assets/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="../assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="../assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="../assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="../assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="../assets/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <!-- <img src="../assets/images/thumbs/auth-img1.png" alt=""> -->
            <img src="../assets/images/bg/ikpri.jpg" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="index.html" class="auth-right__logo">
                    <!-- <img src="../assets/images/logo/logo.png" alt=""> -->
                </a>
                <h2 class="mb-8">Welcome! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account</p>

                <form action="login.php" method="post" onsubmit="return validasi()">
                    <div class="mb-24">
                        <label for="fname" class="form-label mb-8 h6">Username</label>
                        <div class="position-relative">
                            <input type="text" class="form-control py-11 ps-40" id="username" name="username"
                                placeholder="Type your username">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-user"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="password" name="password"
                                placeholder="Enter Current Password">
                            <span
                                class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-lock"></i></span>
                        </div>
                    </div>
                    <input type="hidden" name="login_input" value="1">
                    <button type="submit" class="btn btn-main rounded-pill w-100" name="login_button">Sign In</button>
                </form>
            </div>
        </div>
    </section>

    <script type="text/javascript">
    function validasi() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (username != "" && password != "") {
            return true;
        } else {
            alert('Username dan Password harus di isi !');
            return false;
        }
    }
    </script>

    <!-- Jquery js -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="../assets/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="../assets/js/phosphor-icon.js"></script>
    <!-- file upload -->
    <script src="../assets/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="../assets/js/plyr.js"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- full calendar -->
    <script src="../assets/js/full-calendar.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/editor-quill.js"></script>
    <!-- apex charts -->
    <script src="../assets/js/apexcharts.min.js"></script>
    <!-- Calendar Js -->
    <script src="../assets/js/calendar.js"></script>
    <!-- jvectormap Js -->
    <script src="../assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="../assets/js/jquery-jvectormap-world-mill-en.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>



</body>

</html>