<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require "/vendor/autoload.php";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ImmR4wvT8l5S+u/yTeY9rvGGLVLy46Yap6ant4nDKga0Rc1fxTm5aWJt0322dp8wb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPE6jA9/otIFPp7lEms20dB5/C5K7+QfvbPKSNNm9psRgdB04t89/1O/w1cDnyilFU=');
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
$response = $bot->replyText('<reply token>', 'hello!');
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//$response = $bot->pushMessage('test', $textMessageBuilder);
//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//$response = $bot->pushMessage('exiDaajjk;ljasid', $textMessageBuilder);
//echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

echo "test line";
?>