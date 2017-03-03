
<?php

$access_token = 'TNPzAFWAD9VBJjejExPpEjn00xmsDbOwuWrG8/QU0Rw+iAt0NvokuUlrNLYXrVcmb/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHPKRO/1fy0RZjq3P4OBnegQ4vs9I/ztLSCa6ws/3ytFMwdB04t89/1O/w1cDnyilFU=';

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Sl341jGF275OLqY';
//http://fixie:Sl341jGF275OLqY@velodrome.usefixie.com:80

$url = 'https://api.line.me/v2/profile';

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

?>