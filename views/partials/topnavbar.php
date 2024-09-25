<?php 
// session_start();
// if (!isset($_SESSION['id_user'])) {
//     header('Location: login.php');
// }
 ?>
<div class="top-navbar flex-between gap-16">

    <div class="flex-align gap-16">

    </div>

    <div class="flex-align gap-16">
        <div class="flex-align gap-8">
            <!-- Notification Start -->

            <!-- Notification Start -->


            <!-- Language Start -->
        </div>


        <!-- User Profile Start -->
        <div class="dropdown">
            <button
                class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-relative">
                    <img src="../assets/images/admin.jpg" alt="Image" class="h-32 w-32 rounded-circle">
                    <span
                        class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                    <div class="card-body">
                        <div class="flex-align gap-8 mb-20 pb-20">
                            <img src="../assets/images/admin.jpg" alt="" class="w-54 h-54 rounded-circle">
                            <div class="">
                                <h4 class="mb-0"><?php echo $_SESSION['nama']; ?></h4>
                                <p class="fw-medium text-13 text-gray-200"><?php echo $_SESSION['role']; ?></p>
                            </div>
                        </div>
                        <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                            <li class="pt-8 border-top border-gray-100">
                                <a href="logout.php"
                                    class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-danger-600 d-flex"><i class="ph ph-sign-out"></i></span>
                                    <span class="text">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Profile Start -->

    </div>
</div>