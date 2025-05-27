<?php
session_start();
include("../db.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['id'];
    $status = $_POST['status'];
    $tanggal = date("Y-m-d");

    $cek = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id=$user_id AND tanggal='$tanggal'");
    if (mysqli_num_rows($cek) == 0) {
        mysqli_query($conn, "INSERT INTO absensi (user_id, tanggal, status) VALUES ($user_id, '$tanggal', '$status')");
        echo "<script>alert('Absensi berhasil!')</script>";
    } else {
        echo "<script>alert('Anda sudah absen hari ini.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
        body {
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .absensi-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="absensi-card">
    <h3 class="text-center mb-4">Halo, <?= htmlspecialchars($_SESSION['user']['nama']); ?></h3>

    <form method="post">
        <div class="mb-3">
            <label for="status" class="form-label">Pilih Status Kehadiran:</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alfa">Alfa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Absen Hari Ini</button>
    </form>

    <div class="text-center mt-3">
        <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</div>
</body>
</html>
