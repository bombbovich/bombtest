<?php
$access_token = 'mTZICvfS9VFn9Y8SIZv1c2YEf8eqN1Ik9CNU+nYqN2J9G0K1F4cCFnf9MIMbs51Ib/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHOt8vJfcVrN8naBXP9zm72ZuUH7bPFXSYaIbbMFDkO/RAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Sl341jGF275OLqY';

$replytext = "";

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

			if ($text == "v1") $replytext = "v1out_test";
			elseif ($text == "v2") $replytext = "v2in_out test";
			elseif ($text == "v3") $replytext = "v3 test";
			elseif ($text == "สวัสดี") $replytext = "บ้าป่าว";
			elseif ($text == "ขอโทษ") $replytext = "ไม่ให้อภัย";
			elseif ($text == "id") $replytext = $id;
			else $replytext = $text;
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $replytext
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
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
/*

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

			echo $result . "\r\n";*/
		}
	}
}
echo "OK ทดสอบเพิ่ม";
echo $result;

?>