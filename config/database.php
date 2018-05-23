<?php
$db = 'mysql:dbname=camagru;host=localhost';
$user = 'root';
$password = 'ebertin';

try {
   $dbh = new PDO($db, $user, $password);
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
