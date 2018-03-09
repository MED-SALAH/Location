<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 23/10/2017
 * Time: 23:03
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Title</title>
</head>
<body>
<?php
$servername="localhost";
$dbname="projet_708";
$username="root";
$password="";
// On se connecte à MySQL
$bdd = new PDO("mysql:host=$servername;dbname=$dbname",
    $username,$password);
$req = "SELECT * FROM `comptoir`";
$result = $bdd->query($req);//print_r($result->fetchAll());exit();
if(isset($_GET['Supprimer'])){
  $id= $_GET['id'];//exit();
    $requete = "DELETE FROM `comptoir` WHERE `IdComptoir`='$id'";
    $bdd->exec($requete);
    header("location:affichage.php");
}
if(isset($_GET['Update'])){
    $id= $_GET['id'];
    $address= $_GET['address'];
    $gerant= $_GET['gerant'];
    ?>
    <form>
        <fieldset>
            <legend>Mettre à jour le comptoir</legend>
            <form  method="get">
                <table>
                    <tr>
                        <td></td>
                        <td><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/></td>
                    </tr>
                    <tr>
                        <td>
                            <label>dfpibjdf Comptoir</label>
                            <label>dfpibjdf Comptoir</label>
                        </td>
                        <td>
                            <textarea name="address"><?php echo $_GET['address'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Id Gérant</label>
                        </td>
                        <td>
                        <?php
                    $servername="localhost";
                    $dbname="projet_708";
                    $username="root";
                    $password="";
                    // On se connecte à MySQL
                    $bdd = new PDO("mysql:host=$servername;dbname=$dbname",
                        $username,$password);
                    $req = "SELECT * FROM `gerant`";
                    $result = $bdd->query($req);
                        ?>
                            <select name="gerant">
                                <?php foreach ($result as $res ){ ?>
                                    <option value="<?php echo $res[0] ?>"><?php echo $res[0] ?></option>
                             <?php   } ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submitUpdate" value="Mettre à jour">
                            <input type="reset" value="Annuler">
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </form>
    <?php

}
if(isset($_GET['submitUpdate'])){
    $id= $_GET['id'];
    $address= $_GET['address'];
    $gerant= $_GET['gerant'];
    $requete = "UPDATE `comptoir` SET `AdresseComptoir`='$address',`IdGerant`='$gerant' WHERE `IdComptoir`='$id'";
    $bdd->query($requete);
    if($bdd->query($requete) == true)
        header("location:affichage.php");
}
/* */
?>
<h2>Liste des comptoirs</h2>
<table border="2">
    <th>Adresse</th>
    <th>Gérant</th>
    <th>Suppression</th>
    <th>Mise à jour</th>
    <?php
    foreach ($result as $res){ ?>
        <tr>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td>
                <form method="get">
                    <input type="submit" value="Supprimer" name="Supprimer">
                    <input type="hidden" name="id" value="<?php echo $res[0]; ?>">
                </form>
            </td>
            <td>
                <form method="get">
                    <input type="submit" value="Mettre à jour" name="Update">
                    <input type="hidden" name="id" value="<?php echo $res[0]; ?>">
                    <input type="hidden" name="address" value="<?php echo $res[1]; ?>">
                    <input type="hidden" name="gerant" value="<?php echo $res[2]; ?>">
                </form>
            </td>
        </tr>
 <?php   }
    ?>
</table>
<a href="form.php">Ajouter un nouveau comptoir</a>
</body>
</html>
