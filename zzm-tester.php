<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://itd-skp.sde.dk/api/find.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('what' => 'student-state'),
  CURLOPT_HTTPHEADER => array(
    "Content-Type: multipart/form-data; "
                  //"cache-control: no-cache"
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$json_data = json_encode($response);
var_dump($json_data);// $response;

