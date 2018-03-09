<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');


$data = $bdd->query("select * from produit,typeproduit where produit.idTypeProduit = typeproduit.idTypeProduit");


if(isset($_GET['supp'])){
    $id=$_GET['supp'];
    $bdd->query("delete from produit where IdProduit='$id'");
    echo '<script>alert("supprimer avec succès")</script>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ajouter produit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/grayscale.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom du produit</th>
                <th>Prix HT</th>
                <th>TVA</th>
                <th>Description</th>
                <th>Type produit</th>
               <th><input type="hidden" value="Etat"/></th> 
                <!--<th>Modifier</th>-->
                <th>Voir</th>
                <!--<th>Supprimer</th>-->
            </tr>
        </thead>
        <tbody>
    <?php while ($a = $data->fetch()) { ?>
        <tr>
            <td><?php echo $a['libelleProduit'];?></td>
            <td><?php echo $a['prixHt'];?></td>
            <td><?php echo $a['tauxTva'];?></td>
            <td><?php echo $a['description'];?></td>
            <td><?php echo $a['libelleTypeProduit'];?></td>
            <td><input type="hidden" value="<?php echo $a['etat'];?>"/></td>
            <!--<td><i class="glyphicon glyphicon-pencil"></i></td>-->
            <td><a href="#;" data-id="<?php echo $a['idProduit'] ?>" class="btn btn-primary btn- btn-sm showme"><i class="glyphicon glyphicon-zoom-in"></i></a> </td>
            <!--<td><a href="listProduit.php?supp=<?php echo $a['idProduit']?>"><i class="glyphicon glyphicon-trash"></i></a> </td>
            -->
        </tr>
        <?php


    } ?>
    </tbody>
</table>
<div class="modal fade" id="modalProduit" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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


<script type="text/javascript">
    jQuery(function($){
         $('a.showme').click(function(ev){
             ev.preventDefault();
             var uid = $(this).data('id');
             var infoProduit = $(this).parent().siblings();
             var Libelle = infoProduit.eq(0).text();
             var PrixHT = infoProduit.eq(1).text();
             var TVA = infoProduit.eq(2).text();
             var Description = infoProduit.eq(3).text();
             var LibelleTypeProduit = infoProduit.eq(4).text();
             var etat = infoProduit.eq(5).children().val();
             console.log(etat);  
             infoProduit.each(function( data ){

             })
             $.get('modalProduit.php?id=' + uid +'&libelle=' + Libelle + '&prixht=' + PrixHT + '&tva=' + TVA+ '&desc=' + Description+ '&type=' + LibelleTypeProduit+ '&etat=' + etat, function(html){
                 $('#modalProduit .modal-title').html("Produit n°" + uid + " - " + Libelle);
                 $('#modalProduit .modal-body').html(html);
                 $('#modalProduit').modal('show', {backdrop: 'static'});
             });
         });
    });
</script>

