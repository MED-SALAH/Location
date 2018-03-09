<?php
if (isset($_POST['src'])) {
    ?>
    <?php
    SearchProduct();
} else {
    echo "Erreur";
}
?>


<?php


function SearchProduct()
{
    try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }


    $search = $_POST['src'];

    $sql = "SELECT idProduit, libelleProduit, prixHt, tauxTva, libelleTypeProduit, description, etat, adresseComptoir,img FROM produit INNER JOIN comptoir ON " . "produit.idComptoir = comptoir.idComptoir" . " INNER JOIN typeproduit ON " ."produit.idTypeProduit = typeproduit.idTypeProduit" .  " WHERE libelleProduit LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%'";

    $rowCount = 0;
    $stmt = $bdd->query($sql);
    if ($stmt == TRUE) {
        $table = '<tbody class="req">';

        while ($data = $stmt->fetch()) {
            //var_dump($data);


            $table .= '<tr> <td>' . $data['libelleProduit'] . '</td><td>' . $data['prixHt'] . '</td><td>' . $data['tauxTva'] . '</td><td>' . $data['description'] . '</td><td>' . $data['libelleTypeProduit'] . '</td><td class="dist" data-address="' . $data['adresseComptoir'] . '"><script>getLocation("' . $rowCount . '");</script></td><td class="modalButton"><a href="#;" data-id="' . $data['idProduit'] . '" class="showme"><button class="btn btn-primary btn-sm">plus de details</button>
                    </a></td><td><img src="imageProduit/'.$data['img'].'" width="50px" height="50px" id="myImg"></td><td data-etat="' . $data['etat'] . '">';

            if ($data['etat'] == "louer") {
                $table .= '<h4 style="color: red">Indisponible (Reserver)</h4>';
            } else {
                $table .= '<h4 style="color: blue"> Disponible</h4>';
            }


            $rowCount++;
        }

        $table .= "</td></tr></tbody>";
        echo $table;
    } else {
        echo "Error: " . $sql;
    }


    $bdd = null;
}

?>
	


   