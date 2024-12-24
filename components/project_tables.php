<?php 
  include('config/koneksi.php');

  $query = "SELECT * FROM tb_project";
  $sql = mysqli_query($koneksi , $query);
  $no = 0;

  
  // var_dump($sql);
?>

<div class="row">
<div class="col-12">
  <div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-4">
          Project Table
          <a href="kelola.php" type="button" class="btn btn-secondary text-sm font-weight-bold mb-0 border-radius-lg ms-3">+</a>
        </h6>
      </div>
    </div>
    <div class="card-body px-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center justify-content-center mb-0">
          <tbody>
            <tr>
              <th class="text-uppercase text-xs opacity-7 text-center">No.</th>
              <th class="text-uppercase text-xs opacity-7 text-center">Project Name</th>
              <th class="text-uppercase text-xs opacity-7 text-center">Status</th>
              <th class="text-uppercase text-xs opacity-7 text-center">Start Date</th>
              <th class="text-uppercase text-xs opacity-7 text-center">End Date</th>
              <th class="text-uppercase text-xs opacity-7 text-center">Budget</th>
              <th class="text-uppercase text-xs opacity-7 text-center">Actions</th>
            </tr>
            <?php 
              while ($result = mysqli_fetch_array($sql)) {
            ?>
            <tr>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php echo ++$no ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['project_name'] ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['status'] ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['start_date'] ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['end_date'] ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center"><?php $rupiah = number_format($result['budget'], 0, ',', '.'); echo 'Rp. ' . $rupiah; ?></td>
              <td class="text-xs font-weight-bold mb-0 text-center">
                <a href="kelola.php?ubah=<?php echo $result['id_project'] ?>" type="button" class="btn btn-success text-sm font-weight-bold mb-0 border-radius-lg ms-3">Edit</a>
                <a href="proses/kelola_edit.php?hapus=<?php echo $result['id_project'] ?>" type="button" class="btn btn-danger text-sm font-weight-bold mb-0 border-radius-lg ms-3" onClick="return confirm('Apakah yakin ingin menghapus data?')">Delete</a>
              </td>
            </tr>
            <?php 
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>