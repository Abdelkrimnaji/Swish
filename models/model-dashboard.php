<?php
require_once('models/connect-bdd.php');
function getIdentifier($user, $password) {
    global $bdd;
    $req = $bdd->prepare('SELECT COUNT(id) AS nombre FROM admin WHERE admin.name = :admin AND admin.password = :password'); // Je compte le nombre d'entrée ayant pour mot de passe et login ceux rentrés
    $req->bindValue(':password', $password, PDO::PARAM_STR);
    $req->bindValue(':admin', $user, PDO::PARAM_STR);
    $data = $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    return $res;
}
// dashboard
// Un graphique Histogramme permettant de comparer le nombre de fichiers envoyés par jour 
// d'après le numéro de semaine choisie dans une liste déroulante de l'année un cours.   
// ex : Semaine 12 en 2018 - Lundi 12 fichiers, Mardi 14 fichier, Mercredi 52 fichiers...jusqu'au Dimanche.
function getHistogrammeUpload($week) {
    global $bdd;
    $sql = "SELECT (SELECT WEEK(ADDDATE(upload_date,5-DAYOFWEEK(upload_date)),3)) as week, 
    DAYNAME(upload_date) as day, 
    COUNT(*) AS upload FROM `user_upload`
    WHERE (SELECT WEEK(ADDDATE(upload_date,5-DAYOFWEEK(upload_date)),3)) = :week
    Group by week, day";
   
 
  
    $response = $bdd->prepare( $sql );
      // Bind les paramètres dans la requêtes...
    $response->bindParam(':week', $week, PDO::PARAM_INT);
    $response->execute();
    $upload = $response->fetchAll(PDO::FETCH_ASSOC);
    // Retourne le resultat de la requête
	return $upload;
}
function getHistogrammeDownload($week) {
    
    global $bdd;
    $sql = "SELECT (SELECT WEEK(ADDDATE(download_date,5-DAYOFWEEK(download_date)),3)) as week, 
    DAYNAME(download_date) as day, 
    COUNT(*) AS download FROM `files_downloaded`
    WHERE (SELECT WEEK(ADDDATE(download_date,5-DAYOFWEEK(download_date)),3)) = :week
    Group by week, day";
    $response = $bdd->prepare( $sql );
     // Bind les paramètres dans la requêtes...
    $response->bindParam(':week', $week, PDO::PARAM_INT);
    $response->execute();
    $download = $response->fetchAll(PDO::FETCH_ASSOC);
    // Retourne le resultat de la requête
	return $download;
}
function getAllWeeks() {
    global $bdd;
    $sql = 'SELECT WEEK(ADDDATE(upload_date,5-DAYOFWEEK(upload_date)),3) as week
    FROM user_upload   
    GROUP BY week';
    
    $response = $bdd->prepare( $sql );
    $response->execute();
    $weeks = $response->fetchAll(PDO::FETCH_ASSOC);
    // Retourne le resultat de la requête
	return $weeks;
}

function getExtUpload($week) {

    global $bdd;

    $sql = 'SELECT SUBSTRING_INDEX(file_name,".", -1) as ext,
            (SELECT WEEK(ADDDATE(upload_date,5-DAYOFWEEK(upload_date)),3)) as week, COUNT(*) AS count
            FROM files
            INNER JOIN files_uploaded ON files_uploaded.files_id = files.id
            INNER JOIN user_upload ON user_upload.id = files_uploaded.user_upload_id
            WHERE (SELECT WEEK(ADDDATE(upload_date,5-DAYOFWEEK(upload_date)),3)) = :week
            GROUP BY ext';
    
    $response = $bdd->prepare( $sql );
    $response->bindParam(':week', $week, PDO::PARAM_INT);
    $response->execute();
    $weeks = $response->fetchAll(PDO::FETCH_ASSOC);

    // Retourne le resultat de la requête
	return $weeks;
}



?>
