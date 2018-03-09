<?php 
function AddProduct(){
    try {
    // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
    } catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $tva = $_POST['tva'];
    $desc = $_POST['desc'];
    $typeproduit = $_POST['typeproduit'];


    $sql = "INSERT INTO produit (IdProduit,Libelle,PrixHT,TauxTVA,Description,IdTypeProduit,IdAdmin) VALUES (null,'$name','$price','$tva','$desc','$typeproduit',1)";

    
    if($bdd->query($sql) == TRUE){
        echo "New record created successfully";
} else {
    echo "Error: " . $sql ;
}


    $bdd = null;
}

if(isset($_POST['submit']))
{
   AddProduct();
}else{
    echo "T'es nul";
}
?>