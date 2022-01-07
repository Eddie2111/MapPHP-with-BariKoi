<?php
    $servername     = "localhost";
    $username       = "root";
    $password       = "";
    $dbname         = "location";
    $vehicle        = "car2";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Database Connection failed: \n" . $conn->connect_error);
    }
    else{
        $sql = 'SELECT lat,lng FROM '. $vehicle;
        $sqli = 'SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema="location"'; //under construction
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sqli); //under construction
        $positions = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $positions2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        
    }
    $lat = $positions['lng'];//I messed up on latitude and longitude
    $lon = $positions['lat'];
        
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
    function(data){ //*gets data from api and shows in table *//
        document.querySelector("#distance").innerHTML       = data.place.distance_within_meters;
        document.querySelector("#address").innerHTML        = data.place.address;
        document.querySelector("#area").innerHTML           = data.place.area;
        document.querySelector("#city").innerHTML           = data.place.city;
        document.querySelector("#roadnumber").innerHTML     = data.place.address_components.road;
        document.querySelector("#location").innerHTML       = data.place.location_type;
        document.querySelector("#district").innerHTML       = data.place.district;
        document.querySelector("#subDistrict").innerHTML    = data.place.sub_district;
    });
</script>
</head>

<body>
<div class="container">

    <div id = "MapBox">
    
    </div>
    <div id = "tablebox">
    <div class="header">
        <div class="dropdown">
        <button class="link">Select Cars</button>
        <div class="dropdown-menu">
            <a href="#"><span>car1</span></a></br>
            <a href="#"><span>car1</span></a></br>
            <a href="#"><span>car1</span></a></br>
        </div>
        </div>

    </div>  
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
