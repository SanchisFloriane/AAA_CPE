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
$GLOBALS['PDO'] = new PDO('mysql:host=127.0.0.1;dbname=aaa;charset=utf8', 'root', '2539AL07m');
$smarty = new Smarty();
$smarty->setTemplateDir('./Views');

$auth = new Auth($GLOBALS['PDO']);
$router = new Router($auth);
$smarty->assign("user",$auth->getCurrentUser());
$smarty->assign("date",time());


$smarty->assign("pages",array("Accueil"=>"","Pathologies"=>"pathologies"));
$smarty->assign("pagesRestrict",array("Mon compte"=>"account"));

$router->GET( '', function() use ($smarty) { $smarty->assign("fileToInclude","Home.tpl"); });



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
    $smarty->assign("fileToInclude","Home.tpl");
});



$router->POST( 'account/delete', function() use ($smarty,$auth) {
    $return=$auth->deleteUser($auth->getCurrentUser()['uid'],$_POST['password']);

    if($return['error']) {
        $smarty->assign("fileToInclude","Account.tpl");
        $smarty->assign("error", $return['message']);
    }
    else {
        $smarty->assign("fileToInclude","Home.tpl");
        $smarty->assign("user",null);
        $smarty->assign("message", "Modifications prises en compte.");
    }
});
$router->POST( 'account/updatePassword', function() use ($smarty,$auth) {

    $return=$auth->updateUser($auth->getCurrentUser()['uid'],$_POST['password'],array('password'=>$_POST['newPassword']));
    $smarty->assign("fileToInclude","Account.tpl");
    if($return['error'])
        $smarty->assign("error",$return['message']);
    else
        $smarty->assign("message","Modifications prises en compte.");
});
$router->POST( 'account/updateEmail', function() use ($smarty,$auth) {
    $return=$auth->updateUser($auth->getCurrentUser()['uid'],$_POST['password'],array('email'=>$_POST['newEmail']));
    $smarty->assign("fileToInclude","Account.tpl");
    if($return['error'])
        $smarty->assign("error",$return['message']);
    else
        $smarty->assign("message","Modifications prises en compte.");

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
    $smarty->assign("fileToInclude","Home.tpl");
    $smarty->assign("user",false);
},true);


$router->GET('pathologies', function() use ($smarty) {

    $smarty->assign("fileToInclude","Pathologies.tpl");
    $smarty->assign("meridiens", (new meridienEntityManager())->getList());
    $smarty->assign("pathologies", (new pathologieEntityManager())->getList());
    $smarty->assign("typePathos", array(
        "Luo"=>"l",
        "Grand Luo"=>"l2",
        "Jing Jin"=>"j",
        "Méridien"=>"m",
        "Merveilleux vaisseaux"=>"mv",
        "Organe / Viscère"=>"tf",
    ));
    $smarty->assign("caracteristiquesPathos", array(
        "Plein"=>"p",
        "Chaud"=>"c",
        "Vide"=>"v",
        "Froid"=>"f",
        "Interne"=>"i",
        "Externe"=>"e"
    ));
});

$router->GET('pathologie/:id', function ($id) use (&$auth,$smarty) {
    $smarty->assign("patho", (new pathologieEntityManager())->get($id));
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


