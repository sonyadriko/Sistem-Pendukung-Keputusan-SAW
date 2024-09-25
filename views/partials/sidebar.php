<?php 
session_start();
// if (!isset($_SESSION['id_user'])) {
//     header('Location: login.php');
// }
 ?>
<aside class="sidebar">
    <!-- sidebar close btn -->
    <button type="button"
        class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i
            class="ph ph-x"></i></button>
    <!-- sidebar close btn -->

    <a href="index.php"
        class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10 text-lg">
        <!-- <img src="../assets/images/logo/logo.png" alt="Logo"> -->
        <span class="text-xl font-weight-bold">SAW</span>
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <a href="index.php" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <?php if($_SESSION['role'] == 'admin'){ ?>
                <li class="sidebar-menu__item">
                    <a href="kriteria.php" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Kriteria</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="anggota.php" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Anggota</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="cek_hitung.php" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Hitung</span>
                    </a>
                </li>
                <?php } ?>
                <li class="sidebar-menu__item">
                    <a href="history.php" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">History</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</aside>