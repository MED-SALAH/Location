<head>
    <title>	Calculer trajet </title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <!-- Appel des fonctions javascript -->
    <script type="text/javascript" src="js/calcul.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqxbkh14Qxf_J8KViVva2WKFTNjcjHJ38&libraries=places&callback=initAutocomplete"
    async defer></script>
</head>
<body>
    <div style="margin-top:20%">

    </br></br></br>
		<input id="autocompletedestination" placeholder="Entrer l'adresse de destination" style="width:99%" name="autocompletedestination"  type="text"></input>
		<br/><br/>
    <button onclick="getLocation()">Calculer</button>
</div>
</body>
<script>
//Déclarer deux variables autocomplete pour l'origine et la destination
var autocomplete, autocompletedestination;


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(calculer);


    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}


function initAutocomplete() {

	autocompletedestination = new google.maps.places.Autocomplete(
        (document.getElementById('autocompletedestination')),
        {types: ['geocode']});

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
    var a =
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    return d;
}

function calculer(pos) {

    var latitudeorigin= pos.coords.latitude;
    var longitudeorigin=pos.coords.longitude;
    var latitudedestination=0;
    var longitudedestination=0;

	//recupérer les informations de la destination et calculer le trajet à la fin
	var geocoderdestination = new google.maps.Geocoder();
    var addressdestination = document.getElementById("autocompletedestination").value;
    geocoderdestination.geocode({ 'address': addressdestination }, function (resultsdestination, statusdestination) {
        if (statusdestination == google.maps.GeocoderStatus.OK) {


            latitudee = resultsdestination[0].geometry.location.lat();
            longitudee = resultsdestination[0].geometry.location.lng();

            latitudedestination = latitudee;
            longitudedestination = longitudee;

            var x = getDistanceFromLatLonInKm(latitudeorigin,longitudeorigin,latitudedestination,longitudedestination);

            //Prendre trois chiffres après la virgule
            var conversion = x.toFixed(3);

            window.alert("la distance en km est " + conversion);
            x = 0;

        } else {
            alert("Veuillez vérifier la destination");
        }
    });


};

</script>