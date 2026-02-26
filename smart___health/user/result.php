<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if symptoms are selected
if (!isset($_POST['symptoms']) || empty($_POST['symptoms'])) {
    $_SESSION['error'] = "Please select at least one symptom.";
    header("Location: select_symptoms.php");
    exit;
}

$selected_symptoms = $_POST['symptoms']; // Array of symptom IDs
$ids = implode(",", $selected_symptoms);  // Convert to comma-separated string for SQL

// SQL: Find disease with maximum matching symptoms
$query = "
SELECT d.disease_name, d.description, COUNT(ds.symptom_id) as match_count
FROM disease_symptom ds
JOIN diseases d ON ds.disease_id = d.disease_id
WHERE ds.symptom_id IN ($ids)
GROUP BY ds.disease_id
ORDER BY match_count DESC
LIMIT 1
";

$result = mysqli_query($conn, $query);
$predicted = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prediction Result - Smart Health</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Disease Prediction Result</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow text-center">
                <?php if ($predicted) { ?>
                    <h3>Possible Disease: <?php echo $predicted['disease_name']; ?></h3>
                    <p><?php echo $predicted['description']; ?></p>
                <?php } else { ?>
                    <h4>No disease found matching your symptoms.</h4>
                <?php } ?>
                <a href="select_symptoms.php" class="btn btn-primary mt-3">Try Again</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>