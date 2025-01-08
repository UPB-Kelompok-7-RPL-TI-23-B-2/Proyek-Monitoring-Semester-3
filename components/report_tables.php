<?php 
include('config/koneksi.php');

// Mendapatkan data dari tabel tb_project untuk dropdown
$query_project = "SELECT id_project, project_name FROM tb_project";
$sql_project = mysqli_query($koneksi, $query_project);

// Simpan hasil query ke dalam array
$projects = [];
while ($project = mysqli_fetch_array($sql_project)) {
    $projects[] = $project;
}

// Mendapatkan data dari tabel tb_report
$query_report = "SELECT tb_report.*, tb_project.project_name 
                 FROM tb_report 
                 JOIN tb_project ON tb_report.id_project = tb_project.id_project";
$sql_report = mysqli_query($koneksi, $query_report);
$no = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Table</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <script src="path/to/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-4">
            Report Table
            <button type="button" class="btn btn-secondary text-sm font-weight-bold mb-0 border-radius-lg ms-3" data-bs-toggle="modal" data-bs-target="#addReportModal">+</button>
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
                <th class="text-uppercase text-xs opacity-7 text-center">Report Date</th>
                <th class="text-uppercase text-xs opacity-7 text-center">Status</th>
                <th class="text-uppercase text-xs opacity-7 text-center">Actions</th>
              </tr>
              <?php 
                while ($result = mysqli_fetch_array($sql_report)) {
              ?>
              <tr>
                <td class="text-xs font-weight-bold mb-0 text-center"><?php echo ++$no ?></td>
                <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['project_name'] ?></td>
                <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['report_date'] ?></td>
                <td class="text-xs font-weight-bold mb-0 text-center"><?php echo $result['status'] ?></td>
                <td class="text-xs font-weight-bold mb-0 text-center">
                  <button type="button" class="btn btn-success text-sm font-weight-bold mb-0 border-radius-lg ms-3" data-bs-toggle="modal" data-bs-target="#editReportModal<?php echo $result['id_report']; ?>">Edit</button>
                  <a href="?hapus=<?php echo $result['id_report'] ?>" type="button" class="btn btn-danger text-sm font-weight-bold mb-0 border-radius-lg ms-3" onClick="return confirm('Apakah yakin ingin menghapus data?')">Delete</a>
                </td>
              </tr>

              <!-- Modal for Editing Report -->
              <div class="modal fade" id="editReportModal<?php echo $result['id_report']; ?>" tabindex="-1" role="dialog" aria-labelledby="editReportModalLabel<?php echo $result['id_report']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editReportModalLabel<?php echo $result['id_report']; ?>">Edit Report</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="?update=<?php echo $result['id_report']; ?>">
                        <div class="form-group">
                          <label for="id_project">Project Name:</label>
                          <select id="id_project" name="id_project" class="form-control" required>
                            <?php 
                              foreach ($projects as $project) {
                                $selected = ($project['id_project'] == $result['id_project']) ? 'selected' : '';
                                echo "<option value='{$project['id_project']}' {$selected}>{$project['project_name']}</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="report_date">Report Date:</label>
                          <input type="date" id="report_date" name="report_date" class="form-control" value="<?php echo $result['report_date']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="status">Status:</label>
                          <input type="text" id="status" name="status" class="form-control" value="<?php echo $result['status']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                }
                if ($no == 0) {
                  echo "<tr><td colspan='5' class='text-xs font-weight-bold mb-0 text-center'>No data found</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding Report -->
<div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="addReportModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReportModalLabel">Add Report</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="id_project">Project Name:</label>
            <select id="id_project" name="id_project" class="form-control" required>
              <option value="">Select Project</option>
              <?php 
                foreach ($projects as $project) {
                  echo "<option value='{$project['id_project']}'>{$project['project_name']}</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="report_date">Report Date:</label>
            <input type="date" id="report_date" name="report_date" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
// Proses penambahan data ke tabel tb_report
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['update'])) {
    $id_project = $_POST['id_project'];
    $report_date = $_POST['report_date']; // Format: YYYY-MM-DD
    $status = $_POST['status'];

    // Menyiapkan dan menjalankan statement SQL
    $sql = "INSERT INTO tb_report (id_project, report_date, status) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $id_project, $report_date, $status);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Menutup statement
    $stmt->close();

    // Refresh halaman untuk menampilkan data terbaru
    echo "<meta http-equiv='refresh' content='0'>";
}

// Proses penghapusan data dari tabel tb_report
if (isset($_GET['hapus'])) {
    $id_report = $_GET['hapus'];

    // Menyiapkan dan menjalankan statement SQL
    $sql = "DELETE FROM tb_report WHERE id_report = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_report);

    if ($stmt->execute()) {
      echo '
      <script>
          alert("Berhasil Menghapus Data !");
          window.location.href="tables.php";
      </script>
      ';   
    } else {
      echo '
      <script>
          alert("Gagal Menghapus Data !");
          window.location.href="tables.php";
      </script>
      ';
    }
   // Menutup statement
   $stmt->close();
}

// Proses pembaruan data di tabel tb_report
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['update'])) {
    $id_report = $_GET['update'];
    $id_project = $_POST['id_project'];
    $report_date = $_POST['report_date'];
    $status = $_POST['status'];

    // Menyiapkan dan menjalankan statement SQL
    $sql = "UPDATE tb_report SET id_project = ?, report_date = ?, status = ? WHERE id_report = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("issi", $id_project, $report_date, $status, $id_report);

    if ($stmt->execute()) {
      echo '
      <script>
          alert("Berhasil Mengedit Data !");
          window.location.href="tables.php";
      </script>
      ';   
    } else {
      echo '
      <script>
          alert("Gagal Mengedit Data !");
          window.location.href="tables.php";
      </script>
      ';   
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$koneksi->close();
?>
</body>
</html>