<?php
require "D:\wamp64\www\ProjetPHP\AAA\Model\Entity\pathoEntity.php";
require "D:\wamp64\www\ProjetPHP\AAA\Model\Manager\EntityManager.php";
require "D:\wamp64\www\ProjetPHP\AAA\Model\Manager\pathoEntityManager.php";

if (isset($_POST['creer']))
{
    $patho = new pathoEntity(115, 'RM', 'lv', 'voie luo du Ren Mai vide');
    $manager = new pathoEntityManager();
    $manager->add($patho);
    $patho = $manager->get(115);
    var_dump($patho);
}

?>

<html>
<body>

<form action="test.php" method="post">
    <input type="submit" name="creer">
</form>

</body>
</html>