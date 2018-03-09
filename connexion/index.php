<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == true) {
        echo '<script>alert("erreur de mot de passe")</script>';
    }
}
if (isset($_GET['err'])) {
    if ($_GET['err'] == true) {
        echo '<script>alert("pseudo ou mot de passe vide")</script>';
    }
}
if (isset($_GET['conn'])) {
    if ($_GET['conn'] == true) {
        echo '<script>alert("veuillez vous connecté")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .center_div {
            display: block;
            width: 40%;
            margin: 0 auto;
        }
    </style>
</head>
<body style="background:url(http://localhost/LOCKE-master/img/connectFon.jpg);color:black ">

<div class="container">
    <h2 style="text-align: center">Connexion</h2><br>
    <div class="center_div">

        <form class="form-horizontal" action="cadre.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="pseudo">PSEUDO</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pseudo" placeholder="Enter pseudo" name="pseudo">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Mot de passe</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pwd" placeholder="Enter mot de passe" name="pwd">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember">ce souvenir de moi</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Valider</button>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>

