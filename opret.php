<?php

ob_start();
session_start();

include 'DBCon.php';

if (isset($_POST['GEM'])) {
    $fullName = $_POST['fullname'];
    $ausername = $_POST['username'];
    $apassword = $_POST['password'];
    $status = $_POST['status'];


    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["billede"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["billede"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 1;
    }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists." . "<br>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded." . "<br>";
    } else {
        //Insert product into product table
        $sql = "INSERT INTO `login`(`ID`, `username`, `password`, `status`, `billede`) VALUES (NULL,$ausername,$apassword,$status,$target_file)";


        if (move_uploaded_file($_FILES["billede"]["tmp_name"], $target_file)) {
            //Run query
            $data = mysqli_query($connect, $sql);
        }
    }

    //header("location:index.php");
    mysqli_close($connect);
}
