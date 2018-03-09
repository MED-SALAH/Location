<?php
$uid = $_GET['id'];
$libelle = $_GET['libelle'];
$prixht = $_GET['prixht'];
$tva = $_GET['tva'];
$description = $_GET['desc'];
$typeproduit = $_GET['type'];
$img = $_GET['img'];
$etat = $_GET['etat'];



$html = '<ul>
	<li>id: ' . $uid .'</li>
	<li>Libelle: ' . $libelle .'</li>
	<li>prixht: ' . $prixht .'</li>
	<li>tva: ' . $tva .'</li>
	<li>description: ' . $description .'</li>
	<li>image: <img src="' . $img .'" width="50px" height="50px"></li>
	<li>typeproduit: ' . $typeproduit .'</li></ul><br>';


echo $html;

 if($etat ==="louer"){
 	echo "Ce produit est déjà loué mais vous pouvez le reserver! <br><button class='btn btn-primary'>Reserver</button>";
 }else{
 	echo "Ce produit est actuellement disponible <br> <button class='btn btn-primary'>Louer</button>";
 }

?>

