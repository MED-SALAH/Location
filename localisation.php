<?php 
include 'base.php';
?>
<!DOCTYPE html>
<html>
<head>
    <script async defer src="https://maps.googleapis.com/maps/api/geocode/json"></script>
</head>
<body>
<form action="localisation.php" method="post">
<label for="">adresse</label>
<input type="text" name="adress">
<input type="text" name="adress2">

<button onclick="calculDistance()">Try It</button>
</form>

<p id="demo"></p>
<div id="map"></div>
<script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }
 function calculDistance(oLatLng1,oLatLng2) {

     var tours = new google.maps.LatLng(oLatLng1,oLatLng2);
     var lyon = new google.maps.LatLng(45.764859,4.835036);
     var distance = google.maps.geometry.spherical.computeDistanceBetween( oLatLng1, oLatLng2);
 }
    //
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>




</body>
</html>
<?php
if (isset($_POST['adress'])) {

    $Address=$_POST['adress'];
    $Address2=$_POST['adress2'];
    $lan=lang($Address);
    $lan1=lang($Address2);
    calculDistance($lan,$lan1);
}
function lang($Address){

    $Address = urlencode($Address);
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address='.$Address.'&sensor=false";

    // Make the HTTP request
    $data = @file_get_contents($url);
    // Parse the json response
    $jsondata = json_decode($data,true);



    $LatLng = array(
        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
    );
    return $LatLng;
}

?>
