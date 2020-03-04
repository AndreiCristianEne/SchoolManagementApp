<?php

require_once('database.php');

try{
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['id']) && !empty($_POST['email']) && !empty($_POST['address']) ) {
        $sUpdate = $db->prepare( 'UPDATE students SET firstName = :firstName, lastName = :lastName, email = :email, address = :address WHERE id = :id ' );
        $sUpdate->bindValue( ':lastName' , $_POST['lastName'] );
        $sUpdate->bindValue( ':firstName' , $_POST['firstName'] );
        $sUpdate->bindValue( ':id' , $_POST['id'] );
        $sUpdate->bindValue( ':email' , $_POST['email'] );
        $sUpdate->bindValue( ':address' , $_POST['address'] );
        $sUpdate->execute();
        echo "UPDATED: {$sUpdate->rowCount()} element(s)";
        header('Location: view.php');
    }
}catch( PDOException $ex ){
    echo "EXCEPTION";
}