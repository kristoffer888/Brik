<?php

$variables = [
    "BASE_URL" => "",
    "DB_HOST" => "localhost",
    "DB_USERNAME" => "root",
    "DB_PASSWORD" => "Aa123456&",
    "DB_NAME" => "brik",
];

foreach ($variables as $key => $variable) {
    putenv("$key=$variable");
}