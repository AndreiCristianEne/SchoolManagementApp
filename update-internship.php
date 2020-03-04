<?php

require __DIR__ . '/vendor/autoload.php';
// connect to mongo
$client = new MongoDB\Client("mongodb://localhost:27017");
$cInternships = $client->kea->internships;

if (!empty($_POST['sNewCompanyName']) && !empty($_POST['sNewRequirement'])) { 
    $cInternships->updateOne( ['companyName' => $_GET['company']], 
    ['$set' => ['companyName' => $_POST['sNewCompanyName'], 'requirement' => $_POST['sNewRequirement']]] );
    header('Location:internships.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
</head>
<body>
    
    <div class="container">
    <h4>Update details for <?php echo $_GET['company'] ?></h4> <br>
       <form action="update-internship.php?company=<?php echo $_GET['company']?>&requirement=<?php echo $_GET['requirement']?>" method="post">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="sNewCompanyName" value="<?php echo $_GET['company'] ?>">
            </div>
            <div class="form-group">
                <label>Requirement</label>
                <input type="text" name="sNewRequirement" value="<?php echo $_GET['requirement'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <br>
    <div class="container">
        <a href="internships.php" class="text-success">Back to internships</a>
    </div>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</body>
</html>