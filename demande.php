<?php
include 'base.php';

session_start();
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
if (isset($_GET['idP'])) {
    $etat = "confirme";
    $idR = $_SESSION['idC'];

    $idP = $_GET['idP'];
    $stmt = $bdd->prepare('UPDATE notification SET etat=? WHERE idR=? and idP=?');
    $stmt->execute(array($etat, $idR, $idP));
    echo '<script>alert("demande confirmé")</script>';

}
if (isset($_GET['ref'])) {
    $etat = "non confirme";
    $idR = $_SESSION['idC'];

    $idP = $_GET['ref'];
    $stmt = $bdd->prepare('UPDATE notification SET etat=? WHERE idR=? and idP=?');
    $stmt->execute(array($etat, $idR, $idP));
    echo '<script>alert("demande non confirmé")</script>';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
    div {
        border-width: 1px 2px 3px 2px;
        border-style: solid dotted;
        border-color: black;
        padding: 0 10px;
    }
</style>
<body>
<?php
$data = $bdd->prepare('select * from notification WHERE idR=? and etat=?');
$e = "en attente";
$data->execute(array($_SESSION['idC'], $e));

while ($a = $data->fetch()) {
    ?>

    <div>
        <h3>Un client veut faire une location main a main sur le produit <?php
            $data2 = $bdd->prepare('select * from produit where idProduit=?');
            $idP = $a['idP'];
            $produit="";
            $data2->execute(array($a['idP']));
            while ($b = $data2->fetch()) {

                echo $b['libelleProduit'];
            }

            ?> si vous etes d'accord cliqué sur le button confirmé
            sinon annulé</h3>
        <a href="demande.php?idP=<?php echo $idP; ?>">
            <button class="btn btn-success">confirmer</button>
        </a>
        <a href="demande.php?ref=<?php echo $idP; ?>">
            <button class="btn btn-danger">refuser</button>
        </a>
    </div>
    <?php
}

$data3 = $bdd->prepare("select * from notification where idE=?");
$data3->execute(array($_SESSION['idC']));
while ($c = $data3->fetch()) {
    $da = $bdd->prepare('select * from produit where idProduit=?');
    $idP = $c['idP'];

    $da->execute(array($c['idP']));
    while ($b = $da->fetch()) {

        $pp= $b['libelleProduit'];

        if ($c['etat'] == "non confirme") {
            ?>
            <div>
                <h3>votre demande pour la reservation du produit <?php echo $pp; ?> a etait refusé</h3>
            </div>
            <?php

        }
        if ($c['etat'] == 'confirme') {

            $st = $bdd->prepare("select * from client WHERE numeroIterneClient=?");
            $id = $c['idR'];

            $st->execute(array($id));
            while ($e = $st->fetch()) {

                ?>
                <div>
                    <h3>votre demande pour la reservation du produit <?php echo $pp; ?> a était accépté</h3>
                    <h3><?php echo $e['nom']; ?></h3>
                    <h3><?php echo $e['adresse']; ?></h3>
                    <h3><?php echo $e['telephone']; ?></h3>
                    <h3><?php echo $e['email']; ?></h3>
                </div>
                <?php
            }
        }

        if ($c['etat'] == 'en attente') { ?>
            <h3>votre demande pour la reservation du produit <?php echo $pp; ?>  est en attente de reponse </h3>
            <?php


        }
    }
}
?>


</body>
</html>


