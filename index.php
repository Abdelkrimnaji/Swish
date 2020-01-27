<?php
	// echo($_SERVER["REQUEST_URI"])."<br>";
	// echo "count : ".count($requete)."<br>";
	// echo "req : ";
	// print_r($requete."<br>";
	
	if (isset($_SERVER["REQUEST_URI"])) {
		$requete = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

		$base = "https://swish.abdelkrim-naji.com";
		$controller = (count($requete) === 0)? "file":$requete[0];
		$action = (count($requete) < 2)? "": $requete[1];
		$idFolder = (count($requete) < 3)? 0 : $requete[2];
		$idFile = (count($requete) < 4)? 0 : $requete[3];
		
		switch ($controller) {
			case 'dashboard':
				require_once("controllers/controller-dashboard.php");
				break;	
			case 'file':
				require_once("controllers/controller-file.php");
				break;
			default:
				// echo "Error 404";
				require_once("controllers/controller-file.php");
				break;
		}
	}