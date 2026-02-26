<?php
session_start();
include '../config/db.php'; // Database connection

$message = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(!$check){
        die("Query failed: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($check) == 1){
        $row = mysqli_fetch_assoc($check);

        // Verify hashed password
        if(password_verify($password, $row['password'])){
            // Login successful, set session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];

            header("Location: select_symptoms.php"); // Redirect to homepage/dashboard
            exit;
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login - Smart Health</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">User Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if($message != "") { ?>
                <div class="alert alert-warning"><?php echo $message; ?></div>
            <?php } ?>
            <div class="card p-4 shadow">
                <form method="POST">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    <p class="mt-2 text-center">Don't have an account? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>