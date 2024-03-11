<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Site Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-item {
            margin-right: 20px; 
        }
    </style>
    <script>
        // JavaScript function to scroll to trainers list section
        function scrollToTrainersList() {
            var trainersListSection = document.getElementById('trainers-list-section');
            trainersListSection.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container"> 
        <a class="navbar-brand" href="admin_dashboard.php">Gym Site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav"> 
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registermember.php">Register Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_trainer.php">Register Trainer</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div style="margin-top: 30px;"></div>


<section id="trainers-list-section">   
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
