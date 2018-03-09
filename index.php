<?php
session_start();
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=projet_708;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
if(isset($_GET['sess'])){
    $_SESSION['idC']=$_GET['sess'];
    $idR=$_GET['sess'];

    $data=$bdd->prepare('SELECT * from notification WHERE idR=? AND etat=?');
    $info="en attente";
    $data->execute(array($_GET['sess'],$info));
   $a=$data->rowCount();
    $_SESSION['a']=$a;





}
if(isset($_GET['decc'])) {
    if ($_GET['decc'] == true) {
        session_destroy();
        header("location:http://localhost/locke/index.php");
    }
}
if(isset($_GET['reservation'])){
    echo '<script>alert("votre demande a été pris en charge vous allez recevoir bientot une reponse ")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TeamLocke</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
    type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script  type="text/javascript" src="js/typeahead.bundle.js"></script>

<script type="text/javascript">

        $(document).ready(function(){
            // Defining the local dataset
            var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

            // Constructing the suggestion engine
            var cars = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: cars
            });
            console.log("HELOOOOOOOO");
            // Initializing the typeahead
            $('.typeahead').typeahead({
                    hint: true,
                    highlight: true, /* Enable substring highlighting */
                    minLength: 1 /* Specify minimum characters required for showing result */
                },
                {
                    name: 'cars',
                    source: cars
                });
        });
</script>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



    <link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>


    <!-- Custom styles for this template -->
    <link href="css/grayscale.min.css" rel="stylesheet">


    <link href="css/tableProduit.css" rel="stylesheet">
    <style>
        footer {
            padding: 30px 0;
        }
    </style>




</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">TeamLocke Location</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Nos Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#download">Nos Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                </li>
                <?php if(!empty($_SESSION['idC'])){?>
                    <li class="nav-item">
                        <?php
                                echo '<a class="nav-link js-scroll-trigger" href="demande.php"><button style="background-color: #d4a12e;border-radius: 50px;width: 35px">('.$_SESSION['a'].')</button></a>';

                            ?>
                    </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?decc=true">Deconnexion</a>
                </li>
                <?php }else{?>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="connexion/index.php">Connexion</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Intro Header -->
<header class="masthead">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="brand-heading">TeamLocke</h1>
                    <p class="intro-text">Location d'objet en ligne.
                        <p class="intro-text">Location d'objet en ligne.

                            <a href="#about" class="btn btn-circle js-scroll-trigger">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- About Section -->
        <section id="about" class="content-section text-center" style="background-color: #CCC">
            <div class="container">
               <div class="row">
                <h1>Panel de gestion/recherche de produits </h1></div>
                <div class="recherche">
                    <!--<input name="searchInput" type="text" placeholder="Search here...">-->
                    <input type="text" name="searchInput" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search here..." >

                    <input type="button" value="Rechercher" onclick="Search()">

                </div>


                <!-- Script de geolocation -->
                <script type="text/javascript">

//Déclarer deux variables autocomplete pour l'origine et la destination
var autocomplete, autocompletedestination;


function getLocation(ele) {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos){
            var latitudeorigin= pos.coords.latitude;
            var longitudeorigin=pos.coords.longitude;
            var latitudedestination=0;
            var longitudedestination=0;
            var conversion;
    //recupérer les informations de la destination et calculer le trajet à la fin
    var geocoderdestination = new google.maps.Geocoder();
    //var addressdestination = document.getElementById("autocompletedestination").value;
    var addressdestination = $('tbody tr').eq(ele).children().eq(5).data('address');

    geocoderdestination.geocode({ 'address': addressdestination }, function (resultsdestination, statusdestination) {
        if (statusdestination == google.maps.GeocoderStatus.OK) {


            latitudee = resultsdestination[0].geometry.location.lat();
            longitudee = resultsdestination[0].geometry.location.lng();

            latitudedestination = latitudee;
            longitudedestination = longitudee;

            var x = getDistanceFromLatLonInKm(latitudeorigin,longitudeorigin,latitudedestination,longitudedestination);

            //Prendre trois chiffres après la virgule
            conversion = x.toFixed(3);
            console.log(conversion);
            x = 0;

            //Remplacer dans le td correspondant la nouvelle valeur
            $('tbody tr').eq(ele).children().eq(5).empty();
            $('tbody tr').eq(ele).children().eq(5).append(conversion + "km");
            //$('tbody tr').eq(ele).children().eq(5).removeAttr('data-address');

            autocomplete = null;
            autocompletedestination = null;

        } else {
            //alert("Veuillez vérifier la destination");
        }
    });

});


    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

}



//Foncton pour convertir le degré en radian.Cette fonction va servir pour le calcul de la distance
function deg2rad(deg) {
    return deg * (Math.PI/180)
}

//Fonction pour calculer la distance en KM entre deux villes
function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {

    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2-lat1);  // deg2rad below
    var dLon = deg2rad(lon2-lon1);
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    return d;
}

</script>

<script>



    function calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt1) {
        directionsService.route({
            origin: mapositions,
            destination: compt1,
            avoidTolls: true,
            avoidHighways: false,
            travelMode: google.maps.TravelMode.DRIVING
        }, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
</script>
<script type="text/javascript">
    function Search() {
        var lol;
        $.ajax({
            url: 'produits/rechercher_produit.php',
            method: 'post',
            data: {src: $('[name=searchInput]').val()},
            success: function (msg) {
                lol = msg;
                $('tbody').remove('.req');
                $('#ajaxArray').append(lol);
            },
            error: function () {
            }
        });
    };
</script>


<table class="table table-hover" id="ajaxArray" style="color: black">
    <thead>
        <tr>
            <th id="nm">Nom du produit</th>
            <th id="pr">Prix HT</th>
            <th id="tv">TVA</th>
            <th id="desc">Description</th>
            <th id="tp">Type produit</th>
            <!--<th>Modifier</th>-->
            <th id="ds">Distance</th>

            <th>Voir</th>
            <th>image</th>
            <th>Disponibilité</th>
            <!--<th><input type="hidden" value="Etat"/></th>-->
            <!--<th>Supprimer</th>-->
        </tr>
    </thead>

</table>


<script type="text/javascript">
    function sortTable(f,n){
        var rows = $('#ajaxArray tbody  tr').get();

        rows.sort(function(a, b) {

            var A = getVal(a);
            var B = getVal(b);

            if(A < B) {
                return -1*f;
            }
            if(A > B) {
                return 1*f;
            }
            return 0;
        });

        function getVal(elm){
            var v = $(elm).children('td').eq(n).text().toUpperCase();
            if($.isNumeric(v)){
                v = parseInt(v,10);
            }
            return v;
        }

        $.each(rows, function(index, row) {
            $('#ajaxArray').children('tbody').append(row);
        });
    }
    var f_nm = 1;
    var f_pr = 1;
    var f_desc = 1;
    var f_tv = 1;
    var f_tp = 1;
    var f_ds = 1;
    $("#nm").click(function(){
        f_nm *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_nm,n);
    });
    $("#pr").click(function(){
        f_pr *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_pr,n);
    });
    $("#tv").click(function(){
        f_tv *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_tv,n);
    });
    $("#desc").click(function(){
        f_desc *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_desc,n);
    });
    $("#tp").click(function(){
        f_tp *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_tp,n);
    });
    $("#ds").click(function(){
        f_ds *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_ds,n);
    });

</script>
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
</div>

<script type="text/javascript">
    jQuery(function ($) {
        $('body').on('click', 'a.showme' , function (ev) {
            ev.preventDefault();
            var uid = $(this).data('id');
            var infoProduit = $(this).parent().siblings();
            var Libelle = infoProduit.eq(0).text();
            var PrixHT = infoProduit.eq(1).text();
            var TVA = infoProduit.eq(2).text();
            var Description = infoProduit.eq(3).text();
            var LibelleTypeProduit = infoProduit.eq(4).text();
            var addr = infoProduit.eq(5).data('address');
            var etat = infoProduit.eq(7).data('etat');
            var img = infoProduit.eq(6).children().eq(0).attr('src');
            console.log(addr);




            $.get('modalProduit.php?id=' + uid + '&libelle=' + Libelle + '&prixht=' + PrixHT + '&addr=' + addr + '&tva=' + TVA + '&desc=' + Description + '&type=' + LibelleTypeProduit + '&img=' + img +  '&etat=' + etat, function (html) {
                $('#modalProduit .modal-title').html("Produit n°" + uid + " - " + Libelle);
                $('#modalProduit .modal-body').html(html);
                $('#modalProduit').modal('show', {backdrop: 'static'});

            });

        });
    });


    $(function(){
        $(document).on("click", "#mapButton", function(event){
            $('#googleMap').remove();

            $('#mapButton').parent().append("<div id='googleMap' style='width:100%;height:400px;'></div>");

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(posi){

                    var lat = posi.coords.latitude;
                    var lng = posi.coords.longitude;
                    var destLat;
                    var destLng;


                    var addressdestination = $('#addr').text();
                    console.log("COUCOU" + addressdestination);

                    var geocoderdestination = new google.maps.Geocoder();
                    geocoderdestination.geocode({ 'address': addressdestination }, function (resultsdestination, statusdestination) {
                        if (statusdestination == google.maps.GeocoderStatus.OK) {

                            var latitudee = resultsdestination[0].geometry.location.lat();
                            var longitudee = resultsdestination[0].geometry.location.lng();

                            destLat = latitudee;
                            destLng = longitudee;

                            console.log("destLat " + destLat + "/// destLng:" + destLng);


                    console.log("BLAHBLAHdestLat " + destLat + "/// destLng:" + destLng);

                    var mapCanvas = document.getElementById("googleMap");
                    var myCenter = new google.maps.LatLng(46.61926103,2.83447265);


                    var mapositions = new google.maps.LatLng(lat,lng);
                    var compt1 = new google.maps.LatLng(destLat,destLng);

                    var mapOptions = {center: myCenter, zoom: 5};
                    var map = new google.maps.Map(mapCanvas, mapOptions);
                    var directionsService = new google.maps.DirectionsService;
                    var directionsDisplay = new google.maps.DirectionsRenderer({
                            map: map
                        });

                    var marker = new google.maps.Marker({
                        position:mapositions,
                        map: map,
                        label: "P",
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        title: "ma position"
                    });

                    var marker1 = new google.maps.Marker({
                        position:compt1,
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        label: "CP-1",
                        title: "comptoir 1"
                    });


                    google.maps.event.addListener(marker,'click',function() {
                        var infowindow = new google.maps.InfoWindow({
                            content:"votre position"
                        });
                        infowindow.open(map,marker);
                    });

                    google.maps.event.addListener(marker,'click',function() {
                        map.setZoom(17);
                        map.setCenter(marker.getPosition());
                    });

                    google.maps.event.addListener(marker1,'click',function() {
                        map.setZoom(17);
                        map.setCenter(marker1.getPosition());

                    });
                    calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt1);

                    marker.setMap(map);


                        } else {
                            alert("Veuillez vérifier la destination");
                        }
                    });
                });
            }

        });
    });

</script>

</section>

<!-- Download Section -->
<section id="download" class="download-section content-section text-center">
    <div class="container" style="color: black">

        <h2>Nos Services</h2>

        <p>Notre entreprise propose un service de location d'objet.</p>
        <p>Un client peut louer un objet sur internet ou sur l'un de nos agences.</p>
        <p>Un client peut reserver un objet s'il est deja loué.</p>
        <p>Une location peut ce faire de main a main entre nos clients si ces deux parties sont d'accord.</p>
        <p>Un client peut étre localisé et chercher l'agence la plus proche.</p>

    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="content-section text-center" style="background-color: #0c5460; height: 100%">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Contacter Nous</h2>


                <p><span class="glyphicon glyphicon-map-marker"></span> Reims, France</p>
                <p><span class="glyphicon glyphicon-phone"></span> +21355555555555</p>
                <p><span class="glyphicon glyphicon-envelope"></span> objet@gmail.com</p>


                <ul class="list-inline banner-social-buttons">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg">
                            <i class="fa fa-twitter fa-fw"></i>
                            <span class="network-name">Twitter</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/BlackrockDigital/startbootstrap" class="btn btn-default btn-lg">
                            <i class="fa fa-github fa-fw"></i>
                            <span class="network-name">Github</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg">
                            <i class="fa fa-google-plus fa-fw"></i>
                            <span class="network-name">Google+</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<footer style="height: 10px">
    <div class="container text-center">
        <p>TeamLocke</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->

<!--<script type="text/javascript" src="js/calcul.js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqxbkh14Qxf_J8KViVva2WKFTNjcjHJ38&libraries=places" async defer></script>

<!-- Custom scripts for this template -->
<script src="js/grayscale.min.js"></script>

</body>

</html>
