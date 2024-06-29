<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $redirect = $_GET['redirect'] ?? 'home.php';
            header("Location: $redirect");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $conn->close();
}
?>

<?php include 'header.php';?>

<div class="container-fluid bg-dark d-flex bg-dark text-light justify-content-center align-items-center min-vh-100">
    <div class="col-md-4 border border-success p-4 rounded">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
            <div class="col-auto">
                <a class="text-decoration-none text-success mt-3 d-block text-end" href="register.php">
                    Register <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php endif;?>
        </form>
    </div>
</div>

<?php include 'footer.php';?>
