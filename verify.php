
<?php

$access_token = 'mTZICvfS9VFn9Y8SIZv1c2YEf8eqN1Ik9CNU+nYqN2J9G0K1F4cCFnf9MIMbs51Ib/zDCoAzwHgEWBWEJfDjDToHS7vu9KTnGuxeT/2yJHOt8vJfcVrN8naBXP9zm72ZuUH7bPFXSYaIbbMFDkO/RAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>