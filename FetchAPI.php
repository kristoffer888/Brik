<?php

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://itd-skp.sde.dk/api/find.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('what' => 'student-state'),
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));
$json_string = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo $err . '{"error": "1"}';
} else {
    if (strlen(trim($json_string)) > 3) {
        echo $json_string;
    } else
        echo $err . '{"error": "404 Not Found"}';
}