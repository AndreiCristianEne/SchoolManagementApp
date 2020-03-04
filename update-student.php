<?php

  require_once 'database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Update Student</title>
</head>
<body>

    <div class="container">
    <h3>Update student</h3>
        <form action="update-s.php" method="post">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php if(!empty($_POST['id'])) { echo $_POST['id']; } ?>"
                <label>First Name</label>
                <input type="text" name="firstName" value="<?php if(!empty($_POST['firstName'])) { echo $_POST['firstName']; } ?>">
            </div>
            <div class="form-group">    
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php if(!empty($_POST['lastName'])) { echo $_POST['lastName']; } ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="<?php if(!empty($_POST['address'])) { echo $_POST['address']; } ?>">
            </div>
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>

    <br>
    <div class="container">
        <a href="view.php" class="text-success">Back to main page</a>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>