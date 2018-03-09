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
$idProduit=$_GET['id'];
$data=$bdd->prepare("select * from location where numeroInternePorduit=?");
$data->bindParam(1,$idProduit);
$data->execute();
while ($a=$data->fetch(PDO::FETCH_ASSOC)){
    $dateDebutLocation=$a['dateDebutLoc'];
    $_SESSION['idR']=$a['numeroInterneClient'];
}
if(isset($_GET['contrat'])){
    echo '<script>alert("veuillez accepté les condtions")</script>';
}

if(isset($_GET['loc'])){
    if(isset($_SESSION['idC'])){

        $idC=$_SESSION['idC'];
        $idP = $_GET['id'];
        if(isset($_POST['test'])) {

            $dateD = $_POST['dateD'];
            $dateF = $_POST['dateF'];




            $stmt = $bdd->prepare("INSERT INTO reservation (dateDebutRes,dateFinRes,numeroInternePorduit,numeroInterneClient) VALUES (?, ?, ?,?)");
            $bdd->query("update produit set etat='louer' where idProduit='$idP'");
            $stmt->bindParam(1, $dateD);
            $stmt->bindParam(2, $dateF);
            $stmt->bindParam(3, $idP);
            $stmt->bindParam(4, $idC);
            $stmt->execute();
        }else{
            header("location:http://localhost/locke/reserver.php?contrat=true&id=$idP");
        }

    }else{
        header("location:http://localhost/locke/connexion/index.php");
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
<body style="text-align: center;">



<div class="container">
    <h2>Reservation de l'objet</h2>
    <form class="form-horizontal" action="locataire.php?id=<?php echo $_GET['id'];?>" style="width: 50%" method="post">
        vous pouvez reserver le produit apartir du <?php echo $dateDebutLocation; ?>
            <div class="col-sm-10">
                <input type="hidden" class="form-control" id="dateD" placeholder="Enter date debut" name="dateD" value="<?php echo $dateDebutLocation; ?>">
            </div>
        </div>
        <div class="form-group" style="width:50%;">
            <label class="control-label col-sm-2" for="dateF">choisir la date de fin de location:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="dateF" placeholder="Enter date de fin" name="dateF">
            </div>
        </div>
<br>



        <h2 style="padding-left: 2px">contrat de reservation</h2>
        <h4 style="margin-left: 8%;width: 50%">pour reserver un produit et faire une location main a main il faut que les deux parties soient d'accord
        sur sa donc on vous donne les cordonnées du locataire actuel pour le contacter et finaliser votre reservation</h4>

        <div style="margin-left: 8%">accepter nos conditions et conituer:<input type="checkbox" name="test" value="value1"></div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">reserver</button>
            </div>
        </div>
    </form>
</div>


</body>
</html>
