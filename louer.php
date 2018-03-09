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
if(isset($_GET['contrat'])){
    echo '<script>alert("veuillez accepté les condtions")</script>';
}
//if(isset($_GET['loc'])){
//    echo '<script>alert("location")</script>';
//}
if(isset($_GET['loc'])){
    if(isset($_SESSION['idC'])){

        $idC=$_SESSION['idC'];
        $idP = $_GET['id'];
        if(isset($_POST['test'])) {

            $dateD = $_POST['dateD'];
            $dateF = $_POST['dateF'];

            if ($dateD < $dateF) {


                $stmt = $bdd->prepare("INSERT INTO location (dateDebutLoc,dateFinLoc,numeroInternePorduit,numeroInterneClient) VALUES (?, ?, ?,?)");
                $bdd->query("update produit set etat='louer' where idProduit='$idP'");
                $stmt->bindParam(1, $dateD);
                $stmt->bindParam(2, $dateF);
                $stmt->bindParam(3, $idP);
                $stmt->bindParam(4, $idC);
                $stmt->execute();
            } else echo'<script>alert("date de debut avant la date de fin de location")</script>';
        }else{
            header("location:http://localhost/locke/louer.php?contrat=true&id=$idP");
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
<body>



        <div class="container">
            <h2>Location de l'objet</h2>
            <form class="form-horizontal" action="louer.php?loc=oui&id=<?php echo $_GET['id']?>" style="width: 50%" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="dateD">Choisir la date de debut de location:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dateD" placeholder="Enter date debut" name="dateD">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="dateF">choisir la date de fin de location:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dateF" placeholder="Enter date de fin" name="dateF">
                    </div>
                </div>



                <h2>contrat de location</h2>
                <h4>foidfjjviodfjjvdpofvdfivjdfpivdfviodjfvoidfjboidfjboidf</h4>
                <h4>foidfjjviodfjjvdpofvdfivjdfpivdfviodjfvoidfjboidfjboidf</h4>
                <h4>foidfjjviodfjjvdpofvdfivjdfpivdfviodjfvoidfjboidfjboidf</h4>
                <h4>foidfjjviodfjjvdpofvdfivjdfpivdfviodjfvoidfjboidfjboidf</h4>
                <h4>foidfjjviodfjjvdpofvdfivjdfpivdfviodjfvoidfjboidfjboidf</h4>

                accepter nos conditions et conituer:<input type="checkbox" name="test" value="value1">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
            <div class="modal fade" id="modalProduit" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <p>This is a large modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>
</html>
