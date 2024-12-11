<?php
    include('../config/koneksi.php');

    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $project_name = $_POST['project_name'];
            $status = $_POST['status'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $budget = $_POST['budget'];

            $query = "INSERT INTO tb_project VALUES(null, '$project_name', '$status', '$start_date', '$end_date', '$budget')";
            $sql = mysqli_query($koneksi, $query);

            if($sql) {
                header("Location: ../tables.php");
                // echo "Data Berhasil Ditambahkan";
            } else {
                echo $query;
            }

            // echo $project_name." | ".$status. " | ".$start_date." | ".$end_date." | ".$budget;

            // echo "Tambahkan data <a href='tables.php'>Home</a>";
        } else if($_POST['aksi'] == "edit") {
            echo "Edit Data <a href='tables.php'>Home</a>";

            $id_project = $_POST['id_project'];
            $project_name = $_POST['project_name'];
            $status = $_POST['status'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $budget = $_POST['budget'];

            $query = "UPDATE tb_project SET project_name='$project_name', status='$status', start_date='$start_date', end_date='$end_date', budget='$budget' WHERE id_project = '$id_project';";
            $sql = mysqli_query($koneksi, $query);

            if($sql) {
                header("Location: ../tables.php");
                // echo "Data Berhasil Ditambahkan";
            } else {
                echo $query;
            }
        }
    }

    if(isset($_GET['hapus'])) {
        $id_project = $_GET['hapus'];
        $query = "DELETE FROM tb_project WHERE id_project = '$id_project';";
        $sql = mysqli_query($koneksi, $query);

        if($sql) {
            header("Location: ../tables.php");
            // echo "Data Berhasil Ditambahkan";
        } else {
            echo $query;
        }
        // echo "Hapus Data <a href='tables.php'>Home</a>";
    }
?>