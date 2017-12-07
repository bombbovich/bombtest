
<?php

$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Sl341jGF275OLqY';
//http://fixie:Sl341jGF275OLqY@velodrome.usefixie.com:80
$servername = "203.185.96.48";
$username = "fees";
$password = "tmecfees01";
$dbname = "fees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "SELECT * FROM line_bot";
$resultsql = $conn->query($sql);
echo $resultsql->num_rows;
if ($resultsql->num_rows > 0)
{	echo "inloop";
	while($row = $resultsql->fetch_assoc()) {
    	$textread1 = "UserId = ".$row['lineid']." and Status is ".$row['status']. " :end ";

    	$url = 'https://api.line.me/v2/bot/profile/' . $row['lineid'];

	echo $url;
		
		$headers = array('Authorization: Bearer ' . $access_token);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
    }
    echo $textread1;
}

$sql = "SELECT * FROM line_bot";
$resultsql = $conn->query($sql);
echo $resultsql->num_rows;
if ($resultsql->num_rows > 0)
{	echo "inloop";
	while($row = $resultsql->fetch_assoc()) {
    	$textread1 = "GroupId = ".$row['lineid']." and Status is ".$row['status']. " :end ";

    	$url = 'https://api.line.me/v2/bot/group/' . $row['lineid'] . '/members/ids?';

	echo $url;
		
		$headers = array('Authorization: Bearer ' . $access_token);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
    }
    echo $textread1;
}


?>
