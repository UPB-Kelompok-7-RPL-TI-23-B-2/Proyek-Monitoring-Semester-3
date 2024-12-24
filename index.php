<?php
  session_start();
  if (!isset($_SESSION['login'])) {
      header("Location: login.php");
      exit();
  }

  $title = 'Dashboard';
  function setActiveNavLink($currentPage) {
    $navLinks = [
        'index.php' => 'Dashboard',
        'tables.php' => 'Tables',
        'profile.php'=> 'Profile',
        'logout.php'=> 'Logout',
    ];
  
    $html = '';
    foreach ($navLinks as $page => $label) {
        $isActive = ($currentPage == $page) 
            ? 'active bg-gradient-dark text-dark' 
            : 'text-dark';
        
        $iconClass = [
            'index.php' => 'dashboard',
            'tables.php' => 'table_view',
            'profile.php'=> 'person',
            'logout.php' =>'assignment',
        ];
  
        $html .= '
        <li class="nav-item">
            <a class="nav-link ' . $isActive . '" href="' . $page . '">
                <i class="material-symbols-rounded opacity-5">' . $iconClass[$page] . '</i>
                <span class="nav-link-text ms-1">' . $label . '</span>
            </a>
        </li>';
    }
  
    return $html;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php include "components/header.php"; ?>
  <body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
      <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://pb.ecampus.id/pb/main " target="_blank">
          <img src="assets/img/upb.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
          <span class="ms-1 text-sm text-dark">Kelompok-7 RPL</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-link-text ms-1"><?php echo setActiveNavLink(basename($_SERVER['PHP_SELF'])); ?></li>
        </ul>
      </div>
      <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
          <a class="btn bg-gradient-dark w-100" href="https://pb.ecampus.id/pb/main" type="button">Pelita Bangsa</a>
        </div>
      </div>
    </aside>
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include "components/navbar.php"; ?>
        <?php include "components/dashboard.php" ?>
        <?php include "components/footer.php" ?>
        </div>
      </main>
    <?php include "components/function.php" ?>
  </body>
  <style>
    .anim {
      animation-name: appear;
      animation: appear linear;
      animation-timeline: view();
      animation-range: entry 0% cover 40%;
    }

    @keyframes appear {
      from {
        opacity: 0;
        transform: translateY(-100px);
      }
      to {
        opacity: 1;
        transform: translateY(0px);
      }
    }
  </style>
</html>