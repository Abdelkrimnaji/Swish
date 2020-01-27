<?php

require_once('vendor/autoload.php');
require_once('models/connect-bdd.php');

function getFile_name($fichier) {

    global $bdd;

    $requete = $bdd->prepare('SELECT files.file_name FROM files WHERE files.file_key = :fichier');
    $requete->bindValue(':fichier', $fichier, PDO::PARAM_STR);
    $data = $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    return $resultat;
}

function insertFileUpload($arrayDatas) {

	global $bdd;

	$sql = "INSERT INTO `files`(`file_name`, `file_size`, `file_ext`, `folder_key`, `file_key`)
	 	VALUES (:name, :size, :ext, :folder_key, :file_key)";
		
	// Prépare la requête pour éviter les injections SQL...
	$response = $bdd->prepare( $sql );

	// Bind les paramètres dans la requêtes...
	$response->bindParam(':name', $arrayDatas["name"], PDO::PARAM_STR);
	$response->bindValue(':size', $arrayDatas["size"], PDO::PARAM_STR);
	$response->bindParam(':ext', $arrayDatas["ext"], PDO::PARAM_STR);
	$response->bindParam(':folder_key', $arrayDatas["folder_key"], PDO::PARAM_STR);
    $response->bindParam(':file_key', $arrayDatas["file_key"], PDO::PARAM_STR);
    
	// Exécute la requête...
    $response->execute();
    
}

function insertSenderUpload($sender, $message) {

	global $bdd;

	$sql = "INSERT INTO `user_upload`(`mail_sender`, `message`) 
			VALUES (:sender, :message)";

	// Prépare la requête pour éviter les injections SQL...
	$response = $bdd->prepare( $sql );		

	// Bind les paramètres dans la requêtes...
	$response->bindParam(':message', $message, PDO::PARAM_STR);
	$response->bindParam(':sender', $sender, PDO::PARAM_STR);

	// Exécute la requête...
    $response->execute();
}

function insertFolderDownload($idFolder) {

	global $bdd;

	$sql = "INSERT INTO `files_downloaded`(`folder_key`) 
			VALUES (:idFolder)";

	// Prépare la requête pour éviter les injections SQL...
	$response = $bdd->prepare( $sql );		

	// Bind les paramètres dans la requêtes...
	
	$response->bindParam(':idFolder', $idFolder, PDO::PARAM_STR);

	// Exécute la requête...
	$response->execute();
}

function insertFileDownload($idFile) {

		global $bdd;
	
		$sql = "INSERT INTO `files_downloaded`(`file_key`) 
				VALUES (:idFile)";
	
		// Prépare la requête pour éviter les injections SQL...
		$response = $bdd->prepare( $sql );		
	
		// Bind les paramètres dans la requêtes...
		
		$response->bindParam(':idFile', $idFile, PDO::PARAM_STR);
	
		// Exécute la requête...
		$response->execute();
	}
?>