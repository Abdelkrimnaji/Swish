<?php

require_once('vendor/autoload.php');
require_once('models/model-dashboard.php');

// TWIG LOADER
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
 // RENDER DE LA PAGE PRINCIPAL.
 

switch ($action) {
    case 'log':
    case 'error':
       showlog();
        break;
    case 'verif':
        verif();
         break;
    case 'week':
        showWeek($idFolder);
        break;     
    default:
        showlog();
        break;
}

function showlog(){
    global $twig,$action;
    if($action==="error"){

        echo $twig->render("dashboard/admin.twig", array("error"=>"invalid"));
     }
     else{
        echo $twig->render("dashboard/admin.twig");
    }
} 

function verif(){
    global $twig;

    // $uploadForWeek = getHistogrammeUpload(51);
    // print_r($uploadForWeek); 

    if(isset($_POST['inputName']) && isset($_POST['inputPassword'])){
        
        // Récupérer les champs en POST
        $user = $_POST["inputName"];
        $password = $_POST["inputPassword"];
        
        // Compare avec la BDD pour vérifier que l'utilisateur existe
        $login = getIdentifier($user, $password);

            // Si c'est bon...
            if($login["nombre"]==="1"){
                
                // Démarre une session
                session_start();

                // $arrayContainsAllWeeks = getAllWeeks();
                $_SESSION['user'] = $user;
                $_SESSION['pwd'] = $password;

                $weeks = getAllWeeks();
                // Render la page principal
                echo $twig->render("dashboard/dashboard.twig", array("weeks" => $weeks));

            
            } else {
                header('location:/transfer-system/dashboard/error');
            }
    } 
}

// AJAX
function showWeek($week) {

    global $twig;
    
    $canvas = $twig->render('dashboard/block_ajax_chart.twig');
    $dataUpload = getHistogrammeUpload($week);
    $dataDownload = getHistogrammeDownload($week);
    $dataExtUpload = getExtUpload($week); 
    // $datas = array("canvas" => $canvas, "dataUpload" => $dataUpload, "dataDownload" => $dataDownload);
    $datas = array("canvas" => $canvas, "dataUpload" => $dataUpload, "dataDownload" => $dataDownload, "dataExtUpload" => $dataExtUpload);
    echo json_encode($datas);
    // echo $datas;

    
}


function encryptMyPassword($password) {

    $methode = 'aes-256-cbc';
    $mdp = 'online@2017';
    $iv = '2005947800000000';
                                
    return openssl_encrypt($password,$methode,$mdp,0,$iv);
}



// // Dashboard
// function showHistogramme() {
//     global $twig, $id;
//     if ($id !=0) {
//         $details = bdd_actDetail($id);
//     } elseif ($id < 1 || $id > 52) {
//         $details = bdd_actDetail(1);
//     }
//     echo $twig->render('dashboard.twig', array('' => $details, "base_url" => $base_url));
// }
// switch ($action) {
//     case 'list':
//     histogramme();
//         break;

//     // case 'detail':
//     //     actDetail();
//     //     break;

//     //     default:
// 	// 	echo $twig->render(".twig"); 
// 	// 	break;
// }

?>
