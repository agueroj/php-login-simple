<?php

require 'database.php';
require 'session.php';

if(isset($_POST['id'])){
$consulta = "DELETE FROM `users` WHERE `id`=:id";
$sql = $conn-> prepare($consulta);
$sql -> bindParam(':id', $id, PDO::PARAM_INT);
$id=trim($_POST['id']);

$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
header('Location: /php-login-simple');
}
else{
    echo "<div> The record could not be deleted. </div>";

print_r($sql->errorInfo()); 
}
}
?>
