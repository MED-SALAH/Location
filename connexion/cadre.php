<?php
session_start();
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
if(isset($_GET['decc'])) {
    if ($_GET['decc'] == true) {
        session_destroy();
        header("location:http://localhost/locke/index.php");
    }
}
if(!isset($_SESSION['type'])){
    header("location:index.php?conn=false");
}
if (empty($_POST['pseudo']) or empty($_POST['pwd'])) {
    header("location:index.php?err=true");

} else {
    if (isset($_POST['pseudo'])) {
        $pseudo = $_POST['pseudo'];
        $sql = "select * from user WHERE pseudo='$pseudo'";

        $rep = $bdd->query($sql);

        $donnees = $rep->fetch();

        $session = $donnees['type'];
        $idC=$donnees['idUser'];

        if (empty($session)) {
            header("location:index.php?error=true");
        } else {

            $_SESSION['type'] = $session;
            $_SESSION['idC'] =$idC;
            header("location:http://localhost/locke/index.php?sess=$idC");

        }


    }


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
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">TEAMLOCKE</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if ($_SESSION['type'] == 'gerant') { ?>
                <li><a href="#">Produits</a></li>
                <li><a href="#">Location</a></li>
                <li><a href="#">Comptoirs</a></li>
            <?php } ?>
            <?php if ($_SESSION['type'] == 'admin') { ?>
                <li><a href="#">Gérants</a></li>
                <li><a href="#">Clients</a></li>
            <?php } ?>


        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?decc=true"><span class="glyphicon glyphicon-hand-left"> </span>Deconnexion</a></li>

        </ul>
    </div>
</nav>

<div class="container">

    <p>Bienvenue.</p>
</div>

</body>
</html>


