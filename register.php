<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = "siswa";

    $sql = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Gagal mendaftar.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> <!-- Jika style.css ada di root -->

</head>
<body>
<div class="container-login">
    <div class="card shadow-sm">
        <h3 class="text-center mb-4">Register Siswa</h3>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="nama" placeholder="Nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>
</div>
</body>
</html>
