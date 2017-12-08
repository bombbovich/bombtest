<?php
//$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

//$proxy = 'velodrome.usefixie.com:80';
//$proxyauth = 'fixie:Sl341jGF275OLqY';

print_r($_GET);

$replytext = "";

date_default_timezone_set('Asia/Bangkok');

$now = new DateTime();
//echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
$texttime = $now->format('Y-m-d H:i:s');
echo $texttime;
if (isset($_GET)){
	if (isset($_GET['alarm'])){
		switch ($_GET['alarm']){
			case 1:$replytext = " Alarm CDA LOW Pressure, cda pressure = ";break;
			case 2:$replytext = " Alarm CDA HIGH Pressure, cda pressure = ";break;
			case 3:$replytext = " Alarm N2 LOW Pressure, N2 pressure = ";break;
			case 4:$replytext = " Alarm N2 HIGH Pressure, N2 pressure = ";break;
			case 5:$replytext = " Alarm PCL LOW Pressure, PCL pressure = ";break;
			case 6:$replytext = " Alarm PCL HIGH Pressure, PCL pressure = ";break;
			case 7:$replytext = " Alarm PCH LOW Pressure, PCH pressure = ";break;
			case 8:$replytext = " Alarm PCH HIGH Pressure, PCH pressure = ";break;
			case 9:$replytext = " Alarm PCL LOW Temperature, PCL Temp = ";break;
			case 10:$replytext = " Alarm PCL HIGH Temperature, PCL Temp = ";break;
			case 11:$replytext = " Alarm PCH LOW Temperature, PCH Temp = ";break;
			case 12:$replytext = " Alarm PCH HIGH Temperature, PCH Temp = ";break;
			case 13:$replytext = " UPS Cleanroom Source Status change to > ";break;
			case 14:$replytext = " UPS Utilities Source Status change to > ";break;
		}
	}
	if (isset($_GET['data'])){
		$replytext = $texttime . $replytext;
		$replytext = $replytext . $_GET['data'];
	}
	echo $replytext;

	$id = 'U924d3eaf86d1bc9e757633949f9ba23e';//bombbovich
	//$id = 'C3e2fa8fdacd3da78912d3c7524a1d7a2';//FEES Together
	linesend($id,$replytext);
	//$id = 'C3e2fa8fdacd3da78912d3c7524a1d7a2';//FEES Together
	//linesend($id,$replytext);
	$id = 'U01a6e0a158035b3447a19faf648821db';
	linesend($id,$replytext);

	$id = 'Cfe7e00a2ef082a3a295ae8c231152d47';
	linesend($id,$replytext);
}

echo "Test Bot Send";


function linesend($id,$replytext){
	
	$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

	$proxy = 'velodrome.usefixie.com:80';
	$proxyauth = 'fixie:Sl341jGF275OLqY';


	$messages = [
		'type' => 'text',
		'text' => $replytext
	];

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

?>
