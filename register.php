<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];

    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $hashed_password, $email);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<?php include 'header.php';?>

<div class="container-fluid bg-dark d-flex justify-content-center align-items-center min-vh-100 bg-dark text-white">
    <div class="card p-4 bg-dark border border-success p-4 rounded text-white text-align" style="width: 100%; max-width: 400px;">
        <h2 class="text-center">Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mt-2">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group mt-2">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-success mt-3 w-100">Register</button>
        </form>
    </div>
</div>

<?php include 'footer.php';?>
