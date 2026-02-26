<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .navbar{
            background: linear-gradient(90deg,#0f6d88,#0a4f63);
        }

        .navbar-brand{
            color:white !important;
            font-weight:bold;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .footer{
            background:#0a0f14;
            color:white;
            padding:20px;
            text-align:center;
            margin-top:60px;
        }

        .btn-full{
            width:100%;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Smart Health Admin</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">

    <h2 class="text-center mb-5">Admin Dashboard</h2>

    <div class="row g-4">

        <!-- Manage Symptoms -->
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Manage Symptoms</h5>
                <p class="text-muted">Add, View, Edit, Delete Symptoms</p>
                <a href="add_symptom.php" class="btn btn-primary btn-full mb-2">Add</a>
                <a href="view_symptom.php" class="btn btn-outline-primary btn-full">View</a>
            </div>
        </div>

        <!-- Manage Diseases -->
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Manage Diseases</h5>
                <p class="text-muted">Add, View, Edit, Delete Diseases</p>
                <a href="add_disease.php" class="btn btn-success btn-full mb-2">Add</a>
                <a href="view_disease.php" class="btn btn-outline-success btn-full">View</a>
            </div>
        </div>

        <!-- Manage Doctors -->
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Manage Doctors</h5>
                <p class="text-muted">Add, View, Edit, Delete Doctors</p>
                <a href="add_doctor.php" class="btn btn-warning btn-full mb-2">Add</a>
                <a href="view_doctor.php" class="btn btn-outline-warning btn-full">View</a>
            </div>
        </div>

        <!-- Mapping -->
        <div class="col-md-6 mx-auto mt-4">
            <div class="card p-4 text-center">
                <h5>Disease-Symptom Mapping</h5>
                <p class="text-muted">Map symptoms with diseases</p>
                <a href="map_disease_symptom.php" class="btn btn-info btn-full mb-2">Map</a>
                <a href="view_mapping.php" class="btn btn-outline-info btn-full">View Mapping</a>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    Smart Health Prediction System <br>
    © Reserved by Santosh Kumar
</div>

</body>
</html>


