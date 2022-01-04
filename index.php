<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "location";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Database Connection failed: \n" . $conn->connect_error);
    }

    if (isset($_GET['lat']) && isset($_GET['lon'])) {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
    } else {
        echo "<h1>Latitude and Longitude must be set in URL</h1>";
        echo "<p>Example: <a href='index.php?lat=23.818217&lon=89.956784'>map.php?lat=23.818217&lon=89.956784</a></p>";
        exit;
    }
    ?>
    <?php
    function clickevent($x,$y){
        $lat = $x;
        $lon = $y;
    }
?>

<html lang="en">
<head>
    <title>Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js"></script>
    <link rel="stylesheet" href="style1.css">
    <script>
    $.getJSON("https://barikoi.xyz/v1/api/search/reverse/Mjc2ODo1SVFGRDlCVFZN/geocode?longitude=<?php echo $lon;?>8&latitude=<?php echo $lat;?>&district=true&post_code=true&country=true&sub_district=true&union=true&pauroshova=true&location_type=true&division=true&address=true&area=true",
    function(data){
        document.querySelector("#distance").innerHTML = data.place.distance_within_meters;
        document.querySelector("#address").innerHTML = data.place.address;
        document.querySelector("#area").innerHTML = data.place.area;
        document.querySelector("#city").innerHTML = data.place.city;
        document.querySelector("#roadnumber").innerHTML = data.place.address_components.road;
        document.querySelector("#location").innerHTML = data.place.location_type;
        document.querySelector("#district").innerHTML = data.place.district;
        document.querySelector("#subDistrict").innerHTML = data.place.sub_district;
        
        
        
    });
</script>
</head>

<body>
<div class="container">
    <div id="MapBox">
    </div>
    <div id = "tablebox">
    <table>

  <tr>
    <th>distance within meters</th>
    <td> <p id="distance"></p> </td>
  </tr>
  <tr>
    <th>address</th>
    <td> <p id="address"></p> </td>
  </tr>
  <tr>
    <th>area</th>
    <td> <p id="area"></p> </td>
</tr>
<tr>
    <th>city</th>
    <td> <p id="city"></p> </td>
</tr>
<tr>
    <th>Road Number</th>
    <td> <p id="roadnumber"></p> </td>
</tr>
<tr>
    <th>location-type</th>
    <td> <p id="location"></p> </td>
</tr>
<tr>
    <th>district</th>
    <td> <p id="district"></p> </td>
</tr>
<tr>
    <th>sub-district</th>
    <td> <p id="subDistrict"></p> </td>
</tr>


</table> 
</div>
</div>



    <script>
    $(function () {
        setLocation = [<?php echo $lat;?>, <?php echo $lon;?>];
        var map = L.map('MapBox').setView(setLocation, 16);
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'AcciGone &copy; <a href="https://osm.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        map.attributionControl.setPrefix(false);
        var marker = new L.marker(setLocation, {
            draggable: true
        });
        map.addLayer(marker);
    })
</script>

</body>
<footer>
    <center>
<p>Location : Latitude: <?php echo $lat;?> , Longitude <?php echo $lon;?> <p/>
    </center>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    


</footer>
</html>
