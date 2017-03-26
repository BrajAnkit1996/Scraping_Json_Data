<?php 
    error_reporting(0);
    ini_set('max_execution_time', 0); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "treeboo";

    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<?php
$i = 0; 
$url = 'https://www.treebo.com/api/v2/search/?nearby=false&city=visakhapatnam&country=India';
$html = @file_get_contents($url);

$json = json_decode($html, true);
//echo '<pre>' . print_r($json, true) . '</pre>';
for($i=0;$i<=31;$i++)
{

	$locality = $json["data"]["result"][$i]["area"]["locality"];
	//echo"<br>";
	$city = $json["data"]["result"][$i]["area"]["city"];
	//echo"<br>";
	$country = $json["data"]["result"][$i]["area"]["country"];
	//echo"<br>";
	$pincode = $json["data"]["result"][$i]["area"]["pincode"];
	//echo"<br>";
	$state = $json["data"]["result"][$i]["area"]["state:"];
	//echo"<br>";
	$lat = $json["data"]["result"][$i]["coordinates"]["lat"];
	//echo"<br>";
	$lng = $json["data"]["result"][$i]["coordinates"]["lng"];
	//echo"<br>";
	$hotelname = $json["data"]["result"][$i]["hotelName"];
	//$hotelname = str_replace("'", "", $hotelname1);
	//echo"<br>";
	  $sqlData  = "('".$hotelname."','".$locality."','".$city."','".$pincode."','".$state."','".$country."','".$lat."','".$lng."')";
	  //echo "<br>";

	   $sql = "INSERT INTO details (`hotel_name`,`locality`, `city`,`pincode`,`state`,`country`,`latitude`,`longitude`) VALUES".$sqlData;
	
   			if ($conn->query($sql) === TRUE)
   			{
    			echo "New record created successfully";
       		} 
       		else 
       		{
    			echo "Error: " . $sql . "<br>" . $conn->error;
          	}

}

 ?>