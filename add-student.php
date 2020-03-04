<?php
 
// connect to the database
require_once 'database.php';

// insert command
try{
    $sCreate = $db->prepare( 'INSERT INTO students VALUES(:id, :firstName, :lastName, :email, :address)' );
    $sCreate->bindValue( ':id' , null );
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['address'])) {
        $sCreate->bindValue( ':firstName' , $_POST['firstName'] );
        $sCreate->bindValue( ':lastName' , $_POST['lastName'] );
        $sCreate->bindValue( ':email' , $_POST['email'] );
        $sCreate->bindValue( ':address' , $_POST['address'] );
        $sCreate->execute();
        echo '<div>command executed</div>';
        echo '<div>last inserted ID: '. $db->lastInsertId() .' </div>';
        header('Location: view.php');
}
}catch( PDOException $ex){
    echo 'EXCEPTION executing command';
}

// NOTE: If the insert fails it will increase the autoincrement
// Solution: innodb_autoinc_lock_mode=0
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Create User</title>
</head>
<body>
    
    <div class="container">
    <h3>Add student</h3>
        <form action="add-student.php" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" id="inputName" name="firstName">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="inputLastName" name="lastName">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" id="inputEmail" name="email">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" id="inputAddress" name="address">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
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