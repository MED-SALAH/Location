<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Title</title>
</head>
<body>
<?php
function addComptoir(){


   // try {
        $servername="localhost";
        $dbname="projet_708";
        $username="root";
        $password="";
        // On se connecte à MySQL
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname",
            $username,$password);
  /*  } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }*/
//echo 'test';

    $adress = $_GET['address'];
    $idGerant = $_GET['idGerant'];
//print_r($_POST);exit();
    $req = "INSERT INTO `comptoir`(`AdresseComptoir`, `IdGerant`) VALUES ('$adress','$idGerant')";
    if($bdd->query($req) == TRUE){
        header("location:affichage.php");
    }
    else
        echo 'Error'.$req;
}
if(isset($_GET['Ajouter'])){
    addComptoir();
}

?>
    <fieldset>
        <legend>Ajout d'un nouveau comptoir</legend>
        <form  method="get">
            <table>
                <tr>
                    <td>
                        <label>Adresse Comptoir</label>
                    </td>
                    <td>
                        <textarea name="address"></textarea>
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
                        <select name="idGerant">
                            <?php foreach ($result as $res ){ ?>
                                <option value="<?php echo $res[0] ?>"><?php echo $res[0] ?></option>
                            <?php   } ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="Ajouter" value="Ajouter">
                        <input type="reset" value="Annuler">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>


</body>
</html>