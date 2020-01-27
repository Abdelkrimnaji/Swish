<?php 

    // Fichier pour se connecter à la base de donnée.
    
	$username = 'dbu289639';
    $password = 'Didier15*';
    $database = 'dbs132449';
    $host = 'db5000137287.hosting-data.io';


    try{

        $bdd = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8',$username , $password);

    }catch (Exception $e){

        die('Erreur : ' . $e->getMessage());

    }

?>
