<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all symptoms from database
$symptoms = [];
$symptomQuery = mysqli_query($conn, "SELECT * FROM symptoms ORDER BY symptom_name ASC");
while ($row = mysqli_fetch_assoc($symptomQuery)) {
    $symptoms[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Symptoms - Smart Health</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Select Your Symptoms</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow">
                <form method="POST" action="result.php">
                    <div class="mb-3">
                        <?php if (count($symptoms) > 0) {
                            foreach ($symptoms as $symptom) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="symptoms[]" value="<?php echo $symptom['symptom_id']; ?>" id="symptom<?php echo $symptom['symptom_id']; ?>">
                                    <label class="form-check-label" for="symptom<?php echo $symptom['symptom_id']; ?>">
                                        <?php echo $symptom['symptom_name']; ?>
                                    </label>
                                </div>
                        <?php } } else { ?>
                            <p>No symptoms found. Contact admin.</p>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Predict Disease</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>