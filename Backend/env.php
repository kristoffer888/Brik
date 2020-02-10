<?php

$variables = [
    "BASE_URL" => "",
    "DB_HOST" => "localhost",
    "DB_USERNAME" => "root",
    "DB_PASSWORD" => "",
    "DB_NAME" => "brik",
];

foreach ($variables as $key => $variable) {
    putenv("$key=$variable");
}