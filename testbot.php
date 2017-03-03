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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			//$id = $event['message']['id'];
			$id = $event['source']['userId'];

			if ($text == "test") $replytext = "fees line bot test";
			//elseif ($text == "v2") $replytext = "v2in_out test";
			//elseif ($text == "v3") $replytext = "v3 test";
			//elseif ($text == "สวัสดี") $replytext = "บ้าป่าว";
			//elseif ($text == "ขอโทษ") $replytext = "ไม่ให้อภัย";
			//elseif ($text == "id") $replytext = $id;
			elseif ($text == "facstatus"){
				
				$sql = "SELECT * FROM fac_pressure ORDER by time_p DESC LIMIT 1";
				$resultsql = $conn->query($sql);

				if ($resultsql->num_rows > 0) {
    			// output data of each row
    				while($row = $resultsql->fetch_assoc()) {
        				$textread1 = "FACILITIES PRESSURE Measure <CR> เวลา: " . $row["time_p"]. " <CR>N2: " . $row["n2"]. " bar, CDA: " . $row["cda"]. " bar <CR> PCH: " . $row["PCH"]. " bar, PCL: " . $row["PCL"]. " bar";
    				}
				} else {
    				echo "0 results";
				}

				$sql = "SELECT * FROM fac_temp ORDER by time_t DESC LIMIT 1";
				$resultsql = $conn->query($sql);

				if ($resultsql->num_rows > 0) {
    			// output data of each row
    				while($row = $resultsql->fetch_assoc()) {
        				$textread2 = "FACILITIES Temperature Measure <CR> เวลา: " . $row["time_t"]. "<CR> PCH: " . $row["PCH"]. " 'C, PCL: " . $row["PCL"]. " 'C";
    				}
				} else {
    				echo "0 results";
				}

				$sql = "SELECT * FROM fac_th ORDER by time_th DESC LIMIT 1";
				$resultsql = $conn->query($sql);

				if ($resultsql->num_rows > 0) {
    			// output data of each row
    				while($row = $resultsql->fetch_assoc()) {
        				$textread3 = "FACILITIES CR Environment Measure <CR> เวลา: " . $row["time_th"]. " <CR>Temp Class 100: " . $row["temp_100"]. " 'C, Humidity Class 100: " . $row["humid_100"]. " %RH <CR> Temp Class 10K: " . $row["temp_10k"]. " 'C, Humidity Class 10k: " . $row["humid_10k"]. " %RH";
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


			$replytext = "Push for test ^^";

			$messages = [
				'type' => 'text',
				'text' => $replytext
			];

			//$id = 'bombbovich';

			$url = 'https://api.line.me/v2/bot/message/push';
			$data2 = [
				'to' => $id,
				'messages' => [$messages],
			];
			$post = json_encode($data2);
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
}
echo "OK xx push";
echo $result;

?>