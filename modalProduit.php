<?php
session_start();
if (isset($_SESSION['idC'])) {
    $idC = $_SESSION['idC'];
}

$uid = $_GET['id'];
$libelle = $_GET['libelle'];
$prixht = $_GET['prixht'];
$tva = $_GET['tva'];
$description = $_GET['desc'];
$typeproduit = $_GET['type'];
$addr = $_GET['addr'];
$etat = $_GET['etat'];
$img = $_GET['img'];


echo '<p id="addr">' . $addr .'</p>';
echo '<p><ul>
    <li>id: ' . $uid . '</li><br>
	<img src="' . $img . '" width="250px" height="250px" style="float:right;margin-right:50px">
	<li>Libelle: ' . $libelle . '</li><br>
	<li>prixht: ' . $prixht . '</li><br>
	<li>tva: ' . $tva . '</li><br>
	
	<li>description: ' . $description . '</li><br>
	
	<li>typeproduit: ' . $typeproduit . '</li></ul><br><br>';
	if($etat!="louer") {
        echo  '<button id="mapButton" class="btn btn-primary">Afficher map</button><br>';
    }

 
if ($etat === "louer") {
    if(isset($_SESSION['idC'])) {

        echo "Ce produit est déjà loué mais vous pouvez le reserver! <br><a href='reserver.php?id=" . $uid . "'><button class='btn btn-primary'>Reserver</button></a>";
    }else {
        echo "Ce produit est déjà loué mais vous pouvez le reserver! <br><a href='reserver.php?id=" . $uid . "'><button class='btn btn-primary'>Reserver</button></a>";
    }
} else {
    if(isset($_SESSION['idC'])) {
        echo "Ce produit est actuellement disponible <br> <a href='louer.php?id=" . $uid . "&idC=" . $idC . "'><button class='btn btn-primary'>Louer</button></a>";

    }else {
        echo "Ce produit est actuellement disponible <br> <a href='louer.php?id=" . $uid . "'><button class='btn btn-primary'>Louer</button></a>";
    }

 
}


