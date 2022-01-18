<?php
$server = '172.17.4.100';
$db_username = 'namiAdmin';
$db_password = 'mt_everest_group';
$schema ='data_nile';

$pdo = new PDO('mysql:dbname='.$schema.';host='.$server , $db_username, $db_password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]) ;
?>