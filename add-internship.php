<?php 

require __DIR__ . '/vendor/autoload.php'; 

// connect to mongo 
$client = new MongoDB\Client("mongodb://localhost:27017"); 
$registeredInternship = $client->kea->internships;
$InternshipExists = [];
if(!empty($_POST['companyName']) && !empty($_POST['requirement']) ){ 

    if($registeredInternship->findOne(['companyName'=>$_POST['companyName']]) && 
       $registeredInternship->findOne(['requirement'=>$_POST['requirement']])){ 
            $InternshipExists = [1, 2, 3];
            // header('Location:add-internship.php');
            // exit;
    }
    
    if(!$registeredInternship->findOne(['companyName'=>$_POST['companyName']]) || 
       !$registeredInternship->findOne(['requirement'=>$_POST['requirement']])){ 
            $jRegistered = new stdClass(); 
            $jRegistered->companyName = $_POST['companyName']; 
            $jRegistered->requirement = $_POST['requirement']; 
            $registeredInternship->insertOne($jRegistered); 
            header('Location:internships.php'); 
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
    <title>Add Internship</title>  
</head>
<body>
    
    <div class="container">
    <h4>Create new partner for student internship</h4> <br>
        <form action="add-internship.php" method="post">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="companyName">
            </div>
            <div class="form-group">
                <label>Internship Requirement</label>
                <input type="text" name="requirement">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <div class="container">
        <?php
            echo $InternshipExists ? 'Internship Company & Requirement already registered' : 'fill in the form';
        ?>
    </div>

    <br>
    <div class="container">
        <a href="internships.php" class="text-success">Back to internships</a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

