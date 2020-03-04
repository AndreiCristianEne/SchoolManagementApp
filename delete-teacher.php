<?php

require_once 'database.php';

try{

if (!empty($_POST['id'])) {
    $sDelete = $db->prepare( 'DELETE FROM teachers WHERE id = :id' );
    $sDelete->bindParam( ':id' , $_POST['id'] );
    $sDelete->execute();
    echo "DELETED {$sDelete->rowCount()} element(s)";
    header('Location: view.php');
}
}catch( PDOException $ex){
    echo "EXCEPTION";
}