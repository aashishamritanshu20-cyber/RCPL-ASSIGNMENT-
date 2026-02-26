<?php
session_start();
include '../config/db.php'; // Database connection

$message = "";

if (isset($_POST['register'])) {

    // Get form data safely
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    // Hash the password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(!$check){
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check) > 0) {
        $message = "Email already registered!";
    } else {
        // Insert new user into database
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password, gender, mobile) VALUES ('$name', '$email', '$password_hashed', '$gender', '$mobile')");

        if ($insert) {
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit;
        } else {
            $message = "Registration failed! Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration - Smart Health</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">User Registration</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if($message != "") { ?>
                <div class="alert alert-warning"><?php echo $message; ?></div>
            <?php } ?>
            <div class="card p-4 shadow">
                <form method="POST">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                    <p class="mt-2 text-center">Already have an account? <a href="http://localhost/smart_health/user/login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>