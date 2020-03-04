<?php

require_once 'database.php';

try {
$db->beginTransaction();

if (!empty($_POST['name']) && !empty($_POST['password'])) {
    $sName = $_POST['name'];
    $sPassword = $_POST['password'];
    $stmt = $db->prepare('INSERT INTO admins VALUES(:sName, :sPass)');
    $stmt->bindParam(':sName', $sName);
    $stmt->bindParam(':sPass', $sPassword);
    if($stmt->execute()){
        $stmt = $db->prepare('INSERT INTO admins_second VALUES(:sName, :sPass )');
        $stmt->bindValue(':sName', $sName);
        $stmt->bindValue(':sPass', $sPassword);
        if($stmt->execute()){
            $db->commit();
            echo 'ALL GOOD';
            header('Location: login.php');
        }else{
            $db->rollBack();
        }
    } else{
        $db->rollBack();
    }
}
}
catch(PDOException $ex){
echo 'WRONG - ERROR';
$db->rollBack();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Create admin</title>
</head>
<body>
    
    <div class="container">
    <h3>New Admin</h3> 
        <form action="transaction.php" method="post">
            <div class="form-group">
                <label>Admin Name</label>
                <input type="text" name="name">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <br>
    <div class="container">
        <a href="login.php" class="text-success">Back to login</a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>