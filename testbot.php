<?php
$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Sl341jGF275OLqY';

$replytext = "";

$servername = "203.185.96.48";
$username = "fees";
$password = "tmecfees01";
$dbname = "fees";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

//mysql://b9295cb943dec5:c9e4950e@us-cdbr-iron-east-05.cleardb.net/heroku_35876e5b2564558?reconnect=true

$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b9295cb943dec5";
$password = "c9e4950e";
$dbname = "heroku_35876e5b2564558";

// Create connection
$conn2 = new mysqli($servername, $username, $password, $dbname);
$conn2->set_charset("UTF8");
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
} 
echo "Connected successfully";

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$type = $event['type'];
		$m_time = $event['timestamp'];

		$replyToken = $event['replyToken'];

		if ($event['source']['type'] != ""){
			$u_type = $event['source']['type'];
		}
		else 
			$u_type = "empty";

		if ($event['source']['userId'] != ""){
			$userid = $event['source']['userId'];
		}
		else{
			$userid = "empty";
		}

		if ($event['source']['groupId'] != ""){
			$groupid = $event['source']['groupId'];
		}
		else{
			$groupid = "empty";
		}
		
		if ($event['source']['roomId'] != ""){
			$roomid = $event['source']['roomId'];
		}
		else{
			$roomid = "empty";
		}

		if ($event['message']['id'] != ""){
			$m_id = $event['message']['id'];
		}
		else
			$m_id = "empty";

		if ($event['message']['type'] != ""){
			$m_type = $event['message']['type'];
		}
		else
			$m_type = "empty";

		if ($event['message']['text'] != ""){
			$text = $event['message']['text'];
		}		
		else
			$text = "empty";

		if ($event['message']['originalContentUrl'] != ""){
			$orurl = $event['message']['originalContentUrl'];
		}		
		else
			$orurl = "empty";

		if ($event['message']['previewImageUrl'] != ""){
			$piurl = $event['message']['previewImageUrl'];
		}		
		else
			$piurl = "empty";

		if ($event['message']['fileName'] != ""){
			$filename = $event['message']['fileName'];
		}		
		else
			$filename = "empty";

		if ($event['message']['fileSize'] != ""){
			$filesize = $event['message']['fileSize'];
		}		
		else
			$filesize = "empty";
		
		if ($event['message']['title'] != ""){
			$title = $event['message']['title'];
		}		
		else
			$title = "empty";
		
		if ($event['message']['address'] != ""){
			$address = $event['message']['address'];
		}		
		else
			$address = "empty";
		
		if ($event['message']['latitude'] != ""){
			$latitude = $event['message']['latitude'];
		}		
		else
			$latitude = "empty";
		
		if ($event['message']['longitude'] != ""){
			$longitude = $event['message']['longitude'];
		}		
		else
			$longitude = "empty";
		
		if ($event['message']['packageId'] != ""){
			$packageid = $event['message']['packageId'];
		}		
		else
			$packageid = "empty";

		if ($event['message']['stickerId'] != ""){
			$stickerid = $event['message']['stickerId'];
		}		
		else
			$stickerid = "empty";
		
		$sql = "INSERT INTO line_bot_history (type, m_time, u_type, userID, m_ID, m_type, text, groupID, roomID, orURL, piURL, fileName, fileSize, title, address, latitude, longitude, packageID, stickerID) VALUES ('$type', '$m_time', '$u_type', '$userid', '$m_id', '$m_type', '$text', '$groupid', '$roomid', '$orurl', '$piurl', '$filename', '$filesize', '$title', '$address', '$latitude', '$longitude', '$packageid', '$stickerid')";
		$resultsql = $conn2->query($sql);		

			//	$id = $event['source']['userId'];

		if ($text == "test") $replytext = "fees line bot test";
		elseif ($text == "sql") $replytext = $test;
			//elseif ($text == "v3") $replytext = "v3 test";
			//elseif ($text == "สวัสดี") $replytext = "บ้าป่าว";
			elseif ($text == "ขอโทษ") $replytext = "ไม่ให้อภัย";
			//elseif ($text == "id") $replytext = $id;
		elseif ($text == "facstatus"){
				
			$sql = "SELECT * FROM fac_pressure ORDER by time_p DESC LIMIT 1";
			$resultsql = $conn->query($sql);

			if ($resultsql->num_rows > 0) {
    			// output data of each row
    			while($row = $resultsql->fetch_assoc()) {
        			$textread1 = "FACILITIES PRESSURE Measure \r\nเวลา: " . $row["time_p"]. " \r\nN2: " . $row["n2"]. " bar, CDA: " . $row["cda"]. " bar \r\nPCH: " . $row["PCH"]. " bar, PCL: " . $row["PCL"]. " bar";
    			}
			} else {
    			echo "0 results";
			}

			$sql = "SELECT * FROM fac_temp ORDER by time_t DESC LIMIT 1";
			$resultsql = $conn->query($sql);

			if ($resultsql->num_rows > 0) {
    			// output data of each row
    			while($row = $resultsql->fetch_assoc()) {
        			$textread2 = "FACILITIES Temperature Measure\r\nPCH: " . $row["PCH"]. " 'C, PCL: " . $row["PCL"]. " 'C";
    			}
			} else {
    			echo "0 results";
			}

			$sql = "SELECT * FROM fac_th ORDER by time_th DESC LIMIT 1";
			$resultsql = $conn->query($sql);

			if ($resultsql->num_rows > 0) {
    				// output data of each row
    			while($row = $resultsql->fetch_assoc()) {
        			$textread3 = "FACILITIES CR Environment Measure\r\nTemp Class 100: " . $row["temp_100"]. " 'C\r\nHumidity Class 100: " . $row["humid_100"]. " %RH \r\nTemp Class 10K: " . $row["temp_10k"]. " 'C\r\nHumidity Class 10k: " . $row["humid_10k"]. " %RH";
    			}
			} else {
    			echo "0 results";
			}


				//$replytext = $textread1;
		}
			//else $replytext = $text;
			// Build message to reply back		
	if ($text == "facstatus"){
		$messages1 = [
			'type' => 'text',
			'text' => $textread1
		];
		$messages2 = [
			'type' => 'text',
			'text' => $textread2
		];
		$messages3 = [
			'type' => 'text',
			'text' => $textread3
		];

	}
	else{
		$messages = [
			'type' => 'text',
			'text' => $replytext
		];
	}

			// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';

	if ($text =="facstatus"){
		$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages1,$messages2,$messages3],
		];
	}
	else {
		$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages],
		];
	}


	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	echo $result . "\r\n";

	}
}
echo "OK xx push";
echo $result;

?>
