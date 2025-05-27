<?php 
session_start();
include("db.php");

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['user'] = $data;
        if ($data['role'] == 'admin') {
            header("Location: admin/dashboard.php");
            exit;
        } else {
            header("Location: siswa/absensi.php");
            exit;
        }
    } else {
        $loginError = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> <!-- Gunakan CSS yang sudah kamu buat -->
</head>
<body>
        <body>
    <div class="container-login">
        <div class="card shadow-sm">
            <h3>Login</h3>

            <?php if ($loginError): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($loginError) ?>
                </div>
            <?php endif; ?>

            <form method="post" novalidate>
                <div class="mb-3">
                    <input type="text" name="username" placeholder="Username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>


</body>
</html>
