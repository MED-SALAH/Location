<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');


$data = $bdd->query("select * from client");


if(isset($_GET['supp'])){
    $id=$_GET['supp'];
    $bdd->query("delete from client where NumeroInterne='$id'");
    echo '<script>alert("supprimer avec succès")</script>';
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

<table class="table table-striped">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Date de naissance</th>
        <th>Telephone fixe</th>
        <th>Telephone mobile</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>modifier</th>
        <th>suprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($a = $data->fetch()) { ?>
        <tr>
            <td><?php echo $a['Nom'];?></td>
            <td><?php echo $a['Prenom'];?></td>
            <td><?php echo $a['DateDeNaissance'];?></td>
            <td><?php echo $a['Telephone'];?></td>
            <td><?php echo $a['Mobile'];?></td>
            <td><?php echo $a['Email'];?></td>
            <td><?php echo $a['Adresse'];?></td>
            <td><i class="glyphicon glyphicon-pencil"></i></td>
            <td><a href="listClient.php?supp=<?php echo $a['NumeroInterne']?>"><i class="glyphicon glyphicon-trash"></i></a> </td>

        </tr>
        <?php


    } ?>
    </tbody>
</table>
</body>
</html>




