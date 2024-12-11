<?php 
    $title = 'Project';
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

    include'config/koneksi.php';

        $id_project = '';
        $project_name = '';
        $status = '';
        $start_date = '';
        $end_date = '';
        $budget = '';

    if(isset($_GET['ubah'])) {
        $id_project = $_GET['ubah'];
        $query = "SELECT * FROM tb_project WHERE id_project = '$id_project';";
        $sql = mysqli_query($koneksi, $query);

        $result = mysqli_fetch_assoc($sql);

        $project_name = $result['project_name'];
        $status = $result['status'];
        $start_date = $result['start_date'];
        $end_date = $result['end_date'];
        $budget = $result['budget'];

        // var_dump($result);
        // die();
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
          <span class="ms-1 text-sm text-dark">Kelompok 7 RPL</span>
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
        <form method="POST" action="proses/kelola_edit.php">
            <input type="hidden" value="<?php echo $id_project ?>" name="id_project">
            <div class="container-fluid py-4">
            <div class="ms-3">
            <h3 class="mb-4 h4 font-weight-bolder"><?php echo $title ?></h3>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <label for="project_name">
                        Project Name
                    </label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="project_name" class="form-control" id="project_name" value="<?php echo $project_name ?>" placeholder="Project 1">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <label for="status">
                        Status
                    </label>
                </div>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="" id="status" name="status">
                        <option <?php if($status == "Pending") { echo "selected"; } ?> value="Pending">Pending</option>
                        <option <?php if($status == "On-Progress") { echo "selected"; } ?> value="On-Progress">On-Progress</option>
                        <option <?php if($status == "Completed") { echo "selected"; } ?> value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <label for="start_date">
                        Start Date
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date ?>">
                    </label>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <label for="end_date">
                        End Date
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date ?>">
                    </label>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <label for="budget">
                        Budget
                    </label>
                </div>
                <div class="col-sm-10">
                    <input type="number" name="budget" class="form-control" id="budget" placeholder="123456789" value="<?php echo $budget ?>">
                </div>
            </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <?php
                        if(isset($_GET['ubah'])) {
                    ?>
                        <button type="submit" name="aksi" value="edit" class="btn bg-gradient-dark text-sm font-weight-bold mb-0 border-radius-lg ms-3">
                            Simpan
                        </button>
                    <?php
                        } else { 
                    ?>
                        <button type="submit" name="aksi" value="add" class="btn bg-gradient-dark text-sm font-weight-bold mb-0 border-radius-lg ms-3">
                            Tambahkan
                        </button>
                    <?php
                        }
                    ?>
                    <a href="tables.php" type="button" class="btn btn-danger text-sm font-weight-bold mb-0 border-radius-lg ms-3">
                        Batal
                    </a>
                </div>
            </div>
        </form>
        <?php include "components/footer.php" ?>
        </div>
      </main>
    <?php include "components/function.php" ?>
  </body>
</html>