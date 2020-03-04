<?php
 // database
 require_once 'database.php';

// read
 try{
    $sRead = $db->prepare( 'SELECT * FROM teachers' );
    $sRead->execute();
    $aRows = $sRead->fetchAll();

    $result = $db->prepare('SELECT COUNT(*) FROM teachers');
    $result->execute();
    $number_of_rows = $result->fetchColumn();

    $sReadStudents = $db->prepare( 'SELECT * FROM students' );
    $sReadStudents->execute();
    $aStudentRows = $sReadStudents->fetchAll();

    $resultStudents = $db->prepare('SELECT COUNT(*) FROM students');
    $resultStudents->execute();
    $number_of_rows_students = $resultStudents->fetchColumn();

    // view for the grades and students
    $sGradesView = $db->prepare( 'SELECT * FROM view_student_grades' );
    $sGradesView->execute();
    $aGrades = $sGradesView->fetchAll();

    // get the average grade
    $avgGrade = $db->prepare('SELECT AVG(grade) FROM grades');
    $avgGrade->execute();
    $avg_grade = $avgGrade->fetchColumn();

    // select IN select - see who studies databases
    $sDatabaseStudents = $db->prepare( 'SELECT firstName, lastName FROM students WHERE id IN (SELECT student_id FROM student_courses WHERE course_id = 1)' );
    $sDatabaseStudents->execute();
    $aDatabaseStudents = $sDatabaseStudents->fetchAll();

    // select IN select - see who studies programming
    $sProgrammingStudents = $db->prepare( 'SELECT firstName, lastName FROM students WHERE id IN (SELECT student_id FROM student_courses WHERE course_id = 2)' );
    $sProgrammingStudents->execute();
    $aProgrammingStudents = $sProgrammingStudents->fetchAll();

    // call the stored procedure named test() to see courses
    $storedProcedureStmt = $db->prepare('CALL test()');
    $storedProcedureStmt->execute();
    $aSpRows = $storedProcedureStmt->fetchAll(); 

 }catch( PDOException $ex ){
    echo 'EXCEPTION';
    exit();
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
    <title>School Management System</title>
</head>
<body>

<div class="container">
<h2>Teachers - <?php echo $number_of_rows; ?> currently registered</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aRows as $aRow ){
    echo "<tr>
            <th scope='row' id='number'>{$aRow['id']}</th>
            <td>{$aRow['firstName']}</td>
            <td>{$aRow['lastName']}</td>
            <td>{$aRow['email']}</td>
            <td>{$aRow['address']}</td>
            
            <td>
                <form action='delete-teacher.php' method='post'>
                   <input type='hidden' name='id' value='{$aRow['id']}'>  
                   <button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                </form>
            </td>

            <td>
                <form action='update-teacher.php' method='post'>
                   <input type='hidden' name='id' value='{$aRow['id']}'>
                   <input type='hidden' name='firstName' value='{$aRow['firstName']}'>
                   <input type='hidden' name='lastName' value='{$aRow['lastName']}'>
                   <input type='hidden' name='email' value='{$aRow['email']}'>
                   <input type='hidden' name='address' value='{$aRow['address']}'>  
                   <button type='submit' class='btn btn-warning'><i class='fas fa-edit'></i></button>       
                </form>
            </td>
          </tr>";
  }
  ?>

  </tbody>
</table>
<?php echo "<form action='add-teacher.php' method='post'>
                <button type='submit' class='btn btn-primary'>
                    <i class='fas fa-plus'></i>
                </button>  
            </form>"
?> 
</div>

<hr>

<div class="container">
<h2>Students - <?php echo $number_of_rows_students ?> currently registered</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aStudentRows as $aRow ){
    echo "<tr>
            <th scope='row' id='number'>{$aRow['id']}</th>
            <td>{$aRow['firstName']}</td>
            <td>{$aRow['lastName']}</td>
            <td>{$aRow['email']}</td>
            <td>{$aRow['address']}</td>
            
            <td>
                <form action='delete-student.php' method='post'>
                   <input type='hidden' name='id' value='{$aRow['id']}'>  
                   <button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                </form>
            </td>

            <td>
                <form action='update-student.php' method='post'>
                   <input type='hidden' name='id' value='{$aRow['id']}'>
                   <input type='hidden' name='firstName' value='{$aRow['firstName']}'>
                   <input type='hidden' name='lastName' value='{$aRow['lastName']}'>
                   <input type='hidden' name='email' value='{$aRow['email']}'>
                   <input type='hidden' name='address' value='{$aRow['address']}'>  
                   <button type='submit' class='btn btn-warning'><i class='fas fa-edit'></i></button>       
                </form>
            </td>
          </tr>";
  }
  ?>

  </tbody>
</table>
<?php echo "<form action='add-student.php' method='post'>
                <button type='submit' class='btn btn-primary'>
                    <i class='fas fa-plus'></i>
                </button>  
            </form>"
?> 
</div>

<hr>

<div class="container">
<h2>Student grades - <?php echo round($avg_grade) ?> average</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Grade</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aGrades as $aRow ){
    echo "<tr>
            <td>{$aRow['firstName']}</td>
            <td>{$aRow['lastName']}</td>
            <td>{$aRow['grade']}</td>
          </tr>";
  }
  ?>
  </tbody>
</table>
</div>

<hr>

<div class="container">
<h2>Students following the <b>Database</b> course</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Student First Name</th>
      <th scope="col">Student Last Name</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aDatabaseStudents as $aRow ){
    echo "<tr>
            <td>{$aRow['firstName']}</td>
            <td>{$aRow['lastName']}</td>
          </tr>";
  }
  ?>  
</tbody>
</table>
</div>

<hr>

<div class="container">
<h2>Students following the <b>Programming</b> course</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Student First Name</th>
      <th scope="col">Student Last Name</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aProgrammingStudents as $aRow ){
    echo "<tr>
            <td>{$aRow['firstName']}</td>
            <td>{$aRow['lastName']}</td>
          </tr>";
  }
  ?>  
</tbody>
</table>
</div>

<hr>
<div class="container">
<h2>Available courses</h2>    
</div>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Course Name</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $aSpRows as $aRow ){
    echo "<tr>
            <td>{$aRow['name']}</td>
            <td>{$aRow['start']}</td>
            <td>{$aRow['end']}</td>
          </tr>";
  }
  ?>  
</tbody>
</table>
</div>

<hr>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> 

</body>
</html>