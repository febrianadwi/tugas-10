<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
}

$data = mysqli_query($conn, "SELECT absensi.*, users.nama FROM absensi JOIN users ON absensi.user_id = users.id ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h2 class="mt-5">Data Absensi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($d = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $d['nama']; ?></td>
                    <td><?= $d['tanggal']; ?></td>
                    <td><?= $d['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
