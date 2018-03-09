<?php
session_start();
$idP = $_GET['id'];
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
$data = $bdd->prepare("select numeroInterneClient from location where numeroInternePorduit=?");
$data->bindParam(1, $idP);
$data->execute();
while ($a = $data->fetch(PDO::FETCH_BOTH)) {
    $idC = $a['numeroInterneClient'];
}
if (isset($_SESSION['idC'])) {

    $idC = $_SESSION['idC'];
    $idP = $_GET['id'];
    if (isset($_POST['test'])) {

        $dateD = $_POST['dateD'];
        $dateF = $_POST['dateF'];
        if(strtotime($dateD)< strtotime($dateF)) {


            $stmt = $bdd->prepare("INSERT INTO reservation (dateDebutRes,dateFinRes,numeroInternePorduit,numeroInterneClient) VALUES (?, ?, ?,?)");
            $bdd->query("update produit set etat='louer' where idProduit='$idP'");
            $stmt->bindParam(1, $dateD);
            $stmt->bindParam(2, $dateF);
            $stmt->bindParam(3, $idP);
            $stmt->bindParam(4, $idC);
            $stmt->execute();
            $data3 = $bdd->prepare("insert into notification VALUES (NULL,?,?,?,?,?)");
            $idCe = $_SESSION['idC'];
            $idC=$_SESSION['idR'];
            $et = "en attente";
            $info = "false";
            $data3->bindParam(1, $idCe);
            $data3->bindParam(2, $idC);
            $data3->bindParam(3, $et);
            $data3->bindParam(4, $info);
            $data3->bindParam(5, $idP);
            $data3->execute();


            header("location:http://localhost/locke/index.php?reservation=true");
        }else{
            echo '<script>alert("erreur de date")</script>';
        }

    } else {
        header("location:http://localhost/locke/reserver.php?contrat=true&id=$idP");
    }



}