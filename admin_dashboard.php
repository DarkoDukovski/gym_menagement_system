<?php
require_once 'config.php';
require_once 'navbar.php';
if (!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
</head>
<body>

<?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container">

    <div class='row'>
        <div class="col-md-12">
            <h2>Members list</h2>

            <a href="export.php?what=members" class="btn btn-success btn-sm">Export</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Trainer</th>
                    <th>Photo</th>
                    <th>Training plan</th>
                    <th>Access Card</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT members.*,
                        training_plans.name AS training_plan_name,
                        trainers.first_name AS trainer_first_name,
                        trainers.last_name AS trainer_last_name
                        FROM `members`
                        LEFT JOIN `training_plans` ON members.training_plan_id = training_plans.plan_id
                        LEFT JOIN `trainers` ON members.trainer_id = trainers.trainer_id;";

                $run = $conn->query($sql);
                $results = $run->fetch_all(MYSQLI_ASSOC);
                $select_members = $results;

                foreach ($results as $result) : ?>
                    <tr>
                        <td><?php echo $result['first_name']; ?></td>
                        <td><?php echo $result['last_name']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $result['phone_number']; ?></td>
                        <td><?php
                            if ($result['trainer_first_name']) {
                                echo $result['trainer_first_name'] . " " . $result['trainer_last_name'];
                            } else {
                                echo "No trainer assigned";
                            }
                            ?></td>
                        <td><img style="width: 60px;" src="<?php echo $result['photo_path']; ?>"></td>
                        <td><?php
                            if ($result['training_plan_name']) {
                                echo $result['training_plan_name'];
                            } else {
                                echo "No plan";
                            }
                            ?></td>
                        <td><a target="_blank " href="<?php echo $result['access_card_pdf_path']; ?>">Access Card </a></td>
                        <td><?php
                            $create_at = strtotime($result['created_at']);
                            $new_date = date("F, jS Y", $create_at);
                            echo $new_date;
                            ?></td>
                        <td>
                            <form action="delete_member.php" method="POST">
                                <input type="hidden" name="member_id" value="<?php echo $result['member_id']; ?> ">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <h2>Trainers List</h2>

            <a href="export.php?what=trainers" class="btn btn-success btn-sm">Export</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM trainers";
                $run = $conn->query($sql);
                $results = $run->fetch_all(MYSQLI_ASSOC);

                $select_trainers = $results;

                foreach ($results as $result) : ?>
                    <tr>
                        <td><?php echo $result['first_name']; ?></td>
                        <td><?php echo $result['last_name']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $result['phone_number']; ?></td>
                        <td><?php echo date("F, jS, Y", strtotime($result['created_at'])); ?></td>
                        <td>
                            <form action="delete_trainer.php" method="POST">
                                <input type="hidden" name="trainer_id" value="<?php echo $result['trainer_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-fluid"> 
        <div class="row justify-content-center"> 
            <div class="col-md-6 my-4"> 
                <div class="card p-4"> 
                    <h2 class="text-center mb-4">Assign Trainer to Member</h2> 
                    <form action="assign_trainer.php" method="POST">
                        <div class="mb-3"> 
                            <label for="">Select Member</label>
                            <select name="member" class="form-select">
                                <?php foreach ($select_members as $member) : ?>
                                    <option value="<?php echo $member['member_id'] ?>">
                                        <?php echo $member['first_name'] . " " . $member['last_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3"> 
                            <label for="">Select Trainer</label>
                            <select name="trainer" class="form-select">
                                <?php foreach ($select_trainers as $trainer) : ?>
                                    <option value="<?php echo $trainer['trainer_id'] ?>">
                                        <?php echo $trainer['first_name'] . " " . $trainer['last_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="text-center"> 
                            <button type="submit" class="btn btn-primary">Assign Trainer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>