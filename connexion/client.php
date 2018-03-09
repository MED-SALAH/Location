<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
if(isset($_POST['nom']) and isset($_POST['prenom'])){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $adresse=$_POST['adresse'];
        $tel=$_POST['tel'];
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $date=$_POST['date'];

    $sth=$bdd->query("INSERT INTO client (Nom,Prenom,Adresse,Telephone,Mobile,Email,DateDeNaissance) VALUES('$nom','$prenom','$adresse','$tel','$mobile','$email','$date') ");

    echo '<script>alert("ajoutée avec succès")</script>';
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>ajouter client</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Ajouter un client</h2>
    <form class="form-horizontal" action="client.php" style="width: 50%" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="nom">nom:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nom" placeholder="Enter nom" name="nom">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="prenom">Prenom:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="prenom" placeholder="Enter prenom" name="prenom">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="adresse">Adresse:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="adresse" placeholder="Enter adresse" name="adresse">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="tel">Téléphone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tel" placeholder="Enter adresse" name="tel">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="mobile">Mobile:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mobile" placeholder="Enter adresse" name="mobile">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date de naissance:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" placeholder="Enter date" name="date">
                    </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
