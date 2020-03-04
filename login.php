<?php
ini_set("display_errors", 0);
$aUsers = [];
if( !empty($_POST['name']) && !empty($_POST['password']) ){
    require_once 'database.php';
    $name = $_POST['name'];
    $password = $_POST['password'];
    try{
        $stmt = $db->prepare('SELECT * FROM admins
        WHERE name = :name
        AND password = :password
        LIMIT 1');
        $stmt->bindValue(':name', $name); // prevent sql injections
        $stmt->bindValue(':password', $password); // prevent sql injections
        $stmt->execute();
        $aUsers = $stmt->fetchAll();
        //print_r($aUsers);
        if (isset($aUsers) && $aUsers[0]['name'] == $name && $aUsers[0]['password'] == $password) {
            header('Location: view.php');
        }
    }catch (PDOException $ex){
        echo 'exception';
    }
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
    <title>Log In</title>
</head>
<body>

<div class="container">
    <h3>Log In</h3>
    <form action="login.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input name="name" type="text">
            <br>
            <label>Password</label>
            <input name="password" type="password">
        </div>
        <button type="submit" class="btn btn-primary">Connect</button>
        <a href="transaction.php" class="btn btn-success">New Admin</a>
    </form>
</div>

<div class="container">
<?php
    echo $aUsers ? 'Logged in' : 'not logged in';
?>
</div>

<hr>
<div class="container">
    <a href="internships.php" class="btn btn-warning">Internships</a>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>