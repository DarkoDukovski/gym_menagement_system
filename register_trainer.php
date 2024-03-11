<?php require_once 'config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO trainers (first_name, last_name, email, phone_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $phone_number);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Trainer successfully added";
        $stmt->close();
        $conn->close();
        header('location: admin_dashboard.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php require_once 'navbar.php'; ?>

<div class="container mt-4"> 
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Register Trainer</h2>
                    <form action="register_trainer.php" method="post">
                        <div class="mb-3">
                            <label for="trainerFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="trainerFirstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="trainerLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="trainerLastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="trainerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="trainerEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="trainerPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="trainerPhoneNumber" name="phone_number" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register Trainer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
