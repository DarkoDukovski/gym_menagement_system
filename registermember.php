<?php
require_once 'config.php';
require_once 'navbar.php';
if(!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-Jb4Hp3KlF17VfdyZ+8vPkztfVqLRy9BjN4lEO8vcivL9zNff+x2vrMvD0PnUefBn" crossorigin="anonymous">
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Register Member</h2>
                    <form action="register_member.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="memberFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="memberFirstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="memberLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="memberLastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="memberEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="memberEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="memberPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="memberPhoneNumber" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="trainingPlan" class="form-label">Training Plan</label>
                            <select class="form-control" id="trainingPlan" name="training_plan_id" required>
                                <option value="" disabled selected>Select Training Plan</option>
                                <?php
                                $sql = "SELECT * FROM training_plans";
                                $run = $conn->query($sql);
                                $results = $run->fetch_all(MYSQLI_ASSOC);
                                foreach($results as $result) {
                                    echo "<option value='". $result['plan_id'] ."'>"  . $result['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imageupload" class="form-label">Image Upload</label>
                            <div id="dropzone-upload" class="dropzone"></div>
                            <input type="hidden" name="photo_path" id="photoPathInput">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Register Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<!-- Dropzone JS -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php",
        paramName: "photo",
        maxFilesize: 20, // MB
        acceptedFiles: "image/*",
        init: function() {
            this.on("success", function (file, response) {
                const jsonResponse = JSON.parse(response);
                if(jsonResponse.success) {
                    document.getElementById('photoPathInput').value = jsonResponse.photo_path;
                } else {
                    console.error(jsonResponse.error);
                }
            });
        }
    };
</script>

</body>
</html>
