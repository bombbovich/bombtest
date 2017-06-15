<?php
$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Sl341jGF275OLqY';

print_r($_GET);

$replytext = "";

$replytext = "Push for test ^^";

$messages = [
	'type' => 'text',
	'text' => $replytext
];

$id = 'U924d3eaf86d1bc9e757633949f9ba23e';//bombbovich
//$id = 'C3e2fa8fdacd3da78912d3c7524a1d7a2';//FEES Together

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

?>