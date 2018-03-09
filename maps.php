<!DOCTYPE html>
<html>
<head>

	<!-- Appel des fonctions javascript -->
	<script type="text/javascript" src="js/calcul.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqxbkh14Qxf_J8KViVva2WKFTNjcjHJ38&libraries=places&callback=initAutocomplete"
	async defer></script>

</head>
<body>


<h1>Localisation</h1>
<input id="autocompletedepart" placeholder="Entrer l'adresse de depart" style="width:55%" name="autocompletedepart"  type="text"></input>
<br/><br/>
<input id="autocompletedestination" placeholder="Entrer l'adresse de destination" style="width:55%" name="autocompletedestination"  type="text"></input>
<br/><br/>
<button onclick="getLocation()">Calculer</button>

<button onclick="getLocation2()">cliquer ici pour afficher votre position</button> <button onclick="getLocation2()">trouver Comptoir</button>
<b>Choisir Modes de Transport</b>
<select id="mode" onchange="calcRoute();">
	<option value="DRIV">voiture</option>
	<option value="WALKING">marche</option>
	<option value="BICYCLING">vélo</option>
</select></td></tr>
<br/><br/>
<div id="googleMap" style="width:100%;height:400px;"></div>
<div id="posi" style="width:100%;height:400px;"></div>





<script>
	var x = document.getElementById("posi");

	var autocomplete, autocompletedestination;

	//Déclarer deux variables autocomplete pour l'origine et la destination
	var autocomplete, autocompletedestination,autocompletedepart;




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
		autocompletedepart = new google.maps.places.Autocomplete(
			(document.getElementById('autocompletedepart')),
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

	function getLocation2() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(calculer);
		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	};
/*
	function showPosition(position) {
		x.innerHTML = "Latitude: " + position.coords.latitude +
			"<br>Longitude: " + position.coords.longitude;
	}*/
	function myMap(posi) {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(myMap);
		}else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
		var lat = posi.coords.latitude;
		var lng = posi.coords.longitude;

		var mapCanvas = document.getElementById("googleMap");
		var myCenter = new google.maps.LatLng(46.61926103,2.83447265);
		var compt1 = new google.maps.LatLng(47.218371,-1.5536210);
		var compt2 = new google.maps.LatLng(45.750000,4.850000);
		var compt3 = new google.maps.LatLng(45.188529,5.724524);
		var compt4 = new google.maps.LatLng(43.296482,5.3697799);
		var compt5 = new google.maps.LatLng(47.750839,7.33588800);
		var compt6 = new google.maps.LatLng(48.866667,2.333333);

		var mapositions = new google.maps.LatLng(lat,lng);
		var mapOptions = {center: myCenter, zoom: 5};
		var map = new google.maps.Map(mapCanvas, mapOptions);
		var directionsService = new google.maps.DirectionsService;
		var	directionsDisplay = new google.maps.DirectionsRenderer({
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

		var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix(
			{
				travelMode: 'DRIVING',
				transitOptions: TransitOptions,
				drivingOptions: DrivingOptions,
				unitSystem: UnitSystem,
				avoidHighways: Boolean,
				avoidTolls: Boolean,
			}, callback);

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

		var marker1 = new google.maps.Marker({
			position:compt1,
			map: map,
			draggable: true,
			label: "CP-1",
			title: "comptoir 1"
		});
		var marker2 = new google.maps.Marker({
			position:compt2,
			map: map,
			label: "CP-2",
			title: "comptoir 2"
		});
		var marker3 = new google.maps.Marker({
			position:compt3,
			map: map,
			label: "CP-3",
			title: "comptoir 3"
		});
		var marker4 = new google.maps.Marker({
			position:compt4,
			map: map,
			label: "CP-4",
			title: "comptoir 4"
		});
		var marker5 = new google.maps.Marker({
			position:compt5,
			map: map,
			label: "CP-5",
			title: "comptoir 5"
		});
		var marker6 = new google.maps.Marker({
			position:compt6,
			map: map,
			label: "CP-6",
			title: "comptoir 6"
		});
		google.maps.event.addListener(marker1,'click',function() {
			map.setZoom(17);
			map.setCenter(marker1.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt1);
			getLocation();

		});
		google.maps.event.addListener(marker2,'click',function() {
			map.setZoom(17);
			map.setCenter(marker2.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt2);

		});
		google.maps.event.addListener(marker3,'click',function() {
			map.setZoom(17);
			map.setCenter(marker3.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt3);

		});
		google.maps.event.addListener(marker4,'click',function() {
			map.setZoom(17);
			map.setCenter(marker4.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt4);

		});
		google.maps.event.addListener(marker5,'click',function() {
			map.setZoom(17);
			map.setCenter(marker5.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt5);

		});
		google.maps.event.addListener(marker6,'click',function() {
			map.setZoom(17);
			map.setCenter(marker6.getPosition());
			calculateAndDisplayRoute(directionsService, directionsDisplay, mapositions, compt6);

		});

		marker.setMap(map);
	}
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
	function calculateAndDisplayRoute2(directionsService, directionsDisplay, mapositions, compt2) {
		directionsService.route({
			origin: mapositions,
			destination: compt2,
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
	function calculateAndDisplayRoute3(directionsService, directionsDisplay, mapositions, compt3) {
		directionsService.route({
			origin: mapositions,
			destination: compt3,
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
	function calculateAndDisplayRoute4(directionsService, directionsDisplay, mapositions, compt4) {
		directionsService.route({
			origin: mapositions,
			destination: compt4,
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
	function calculateAndDisplayRoute5(directionsService, directionsDisplay, mapositions, compt5) {
		directionsService.route({
			origin: mapositions,
			destination: compt5,
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
	function calculateAndDisplayRoute6(directionsService, directionsDisplay, mapositions, compt6) {
		directionsService.route({
			origin: mapositions,
			destination: compt6,
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB057dl5yhf3nQP-AEc7cgWA8RymovwrCc&callback=myMap"></script>

</body>
</html>
