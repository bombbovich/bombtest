<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'af688c7740b64fc4b521e78644f79a55']);

//$response = $bot->getProfile('bombbovich');
//if ($response->isSucceeded()) {
//    $profile = $response->getJSONDecodedBody();
//    echo $profile['displayName'];
//   echo $profile['pictureUrl'];
//    echo $profile['statusMessage'];
//}
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//$response = $bot->pushMessage('<reply token>', $textMessageBuilder);

//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
//$response = $bot->replyText('<reply token>', 'hello!');
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//$response = $bot->pushMessage('test', $textMessageBuilder);
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//$response = $bot->pushMessage('exiDaajjk;ljasid', $textMessageBuilder);
//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('สวัสดีครับ FEES ทุกท่าน');
$response = $bot->replyMessage($event->getReplyToken(), $textMessageBuilder);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}

// Failed
echo $response->getHTTPStatus . ' ' . $response->getRawBody();

echo "test line";
?>