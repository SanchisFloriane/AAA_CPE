<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23/04/2018
 * Time: 16:06
 */
require_once("vendor/autoload.php");
require_once("controller/GroupBy.php");
require_once("controller/Router.php");
require_once("controller/Auth/Auth.php");
foreach (glob(  'controller/EntityManager/*.php') as $file) {
    if(is_file($file))
        require_once($file);
}
$GLOBALS['PDO'] = new PDO('mysql:host=localhost;dbname=aaa;charset=utf8', 'root', '');
$smarty = new Smarty();
$smarty->setTemplateDir('./Views');

$auth = new Auth($GLOBALS['PDO']);
$router = new Router($auth);
$smarty->assign("user",$auth->getCurrentUser());
$smarty->assign("date",time());


$smarty->assign("pages",array("Accueil"=>"","Pathologies"=>"pathologies","Ressources"=>"ressources"));
$smarty->assign("pagesRestrict",array("QuePourLesCo"=>""));

$router->GET( '', function() use ($smarty) { $smarty->assign("fileToInclude","Accueil.tpl"); });



//Auth
$router->POST( 'register', function() use ($smarty,$auth) {
    $return = $auth->register($_POST);
    if($return['error'])
        $smarty->assign("error",$return['message']);
    else
        $smarty->assign("message","Vous êtes enregistré avec succès, nous n'avons pas implémenté la validation par courrier éléctronique, votre compte est utilisable dès maintenant");
    $smarty->assign("user",$auth->getCurrentUser());
    $smarty->assign("fileToInclude","Login.tpl");
});
$router->POST( 'login', function() use ($smarty,$auth) {
    $return = $auth->login($_POST['email'],$_POST['password'],1);
    if($return['error'])
        $smarty->assign("error",$return['message']);
    else
        $smarty->assign("message","Vous êtes désormais connecté");
    $smarty->assign("user",$auth->getCurrentUser());
    $smarty->assign("fileToInclude","Accueil.tpl");
});

$router->GET('api/emailValid/:email', function ($email) use (&$auth,$smarty) {
    $isEmailTaken = $auth->isEmailTaken(urldecode($email));
    $isEmailValid = $auth->validateEmail(urldecode($email));
    if($isEmailTaken) {
        echo json_encode(['error' => true, 'message' => "L'adresse email est déjà prise"]);
        exit();
    }else{
        echo json_encode($isEmailValid);
    }
    die();
});

$router->GET('logout',function() use ($smarty,$auth){

    $auth->logout($auth->getSessionHash());
    $smarty->assign("fileToInclude","Accueil.tpl");
    $smarty->assign("user",false);
},true);


$router->GET('pathologies', function() use ($smarty) {
    require_once "Model/pathoEntity.php";





    $test = array_group_by( $GLOBALS['PDO']->query("SELECT * FROM Pathologies")->fetchAll() , "idP");

    $smarty->assign("fileToInclude","Pathologies.tpl");
    $smarty->assign("meridiens", (new meridienEntityManager())->getList());
    $smarty->assign("test", $test);
    $smarty->assign("pathos", (new pathoEntityManager())->getList());
    $smarty->assign("typePathos", array(
        "Luo"=>"l",
        "Grand Luo"=>"l2",
        "Jing Jin"=>"j",
        "Méridien"=>"m",
        "Merveilleux vaisseaux"=>"mv",
        "Organe / Viscère"=>"t",
    ));
    $smarty->assign("caracteristiquesPathos", array("Plein"=>"p",
        "Chaud"=>"c",
        "Vide"=>"v",
        "Froid"=>"f",
        "Interne"=>"i",
        "Externe"=>"e"
    ));
});

$router->GET('pathologie/:id', function ($id) use (&$auth,$smarty) {
    echo $smarty->fetch("DetailPathologie.tpl");
    die();
});

$router->GET(':page', function($page) use ($smarty) {
    $smarty->assign("fileToInclude",$page.".tpl");
});



$router->listen();


try {
    $smarty->display("Template.tpl");
} catch (SmartyException $e) {
    $smarty->assign("fileToInclude",NULL);
    $smarty->assign("error",$e->getMessage());
    $smarty->display("Template.tpl");
}


