<?php

require __DIR__ . '/vendor/autoload.php';
// connect to mongo
$client = new MongoDB\Client("mongodb://localhost:27017");
$cInternships = $client->kea->internships;
$aInternships = $cInternships->find()->toArray();

if (isset($_GET['company'])) {
    $companyName = $_GET['company'];
    $cInternships->deleteOne(["companyName" => $companyName]);
    $aInternships = $cInternships->find()->toArray();
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
    <title>Internships</title>   
</head>
<body>
    <div class="container">
    <h2>Partner Internship Companies</h2><br>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Internship Company ID</th>
            <th scope="col">Company Name</th>
            <th scope="col">Requirement</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($aInternships as $user) {
            echo "<tr>
            <th scope='row'>$user->_id</th>
            <td>$user->companyName</td>
            <td>$user->requirement</td>
            
            <td>
            <a href='update-internship.php?company=$user->companyName&requirement=$user->requirement'><i class='far fa-edit text-primary'></i></a>
            </td>
            
            <td>
            <a href='internships.php?company=$user->companyName'><i class='far fa-trash-alt text-danger'></i></a>
            </td>
            
            </tr>";
        }
        ?>
        </tbody>
    </table>

<?php echo "<form action='add-internship.php' method='post'>
                <button type='submit' class='btn btn-success'>
                    <i class='fas fa-plus'></i>
                </button>  
            </form>"
?>

</div>

    <br>
    <div class="container">
        <a href="login.php" class="text-info">Back to login</a>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>  
</body>
</html>