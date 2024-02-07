<?php

require_once 'config.php';

if(!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
 
</head>
<body>


<div class="container">
    <div class="row mb-5">
        <div class="col-md-6">
            <h2>Register member</h2>
            <form action="register_member.php" method="post" enctype="multipart/form-data">
                First Name: <input class="form-control" type="text" name="first_name"><br>
                Last Name: <input class="form-control" type="text" name="last_name"><br>
                Email: <input class="form-control" type ="email" name="email"><br>
                Phone number: <input class="form-control" type ="phone_number" name="email"><br>
                Training Plan:
                <select class="form-control" name="training_plan_id">
                    <option value ="" disabled selected >Training Plan</option>
                    <option value ="" >12 Session Plan</option>
                    <option value ="" >30 Session Plan</option>
                </select><br>
                <input type="hidden" name="photo_path" id="photoPathInput">
                <div id="dropzone-upload" class="dropzone"></div>

                <input class="btn btn-primary mt-3" type="submit" value="Register Member">
                </form>
</div>
</div>
 </div>




</body>
</html>





