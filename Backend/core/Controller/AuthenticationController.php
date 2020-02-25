<?php
namespace core\Controller;

use core\Database;
use core\Route\IRequest;


class AuthenticationController{

    private static function getDB(){
        return new Database(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_NAME"));
    }

    private static function validateImage($img, $img_name){
        $img_file = $img;
        $img_name_st = $img_name;

        $targetDir = "/home/infotavle.itd-skp.sde.dk/public_html/brik/Backend/public/images/";
        $fileName = basename($img_name_st);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');

        //Check allow types of image.
        if (in_array($fileType, $allowTypes)){
            //upload/move to server
            if (move_uploaded_file($img_file["tmp_name"], $targetFilePath)){
                return true;
            }
            else
            {
                $error_msg = 'Failed to upload to server!';
                echo $error_msg;
                return false;
            }
        }
        else
        {
            $error_msg ="Sorry, only JPG, JPEG and PNG files are allowed to upload. 
                        '". $img_name_st . "' is not allowed!";
            echo $error_msg;
            return false;
        }
    }

    public static function register(IRequest $request){
        $body = $request->getBody();  // metoden indeholde al data fra klient side - fx firstname, lastname etc.
        if (isset($body["opret-button"]))
        {            
            $userId = $body["user_id"];
            //$userId = 71;
            $fname = $body["first_name"];
            $lname = $body["last_name"];            
            $img = $request->getFile("file");
            $img_name = $img["name"];            

            // check if any of input field is empty.
            if ( empty($userId) || empty($fname) || empty($lname) || empty($img)){
                return "Please fill in all input fields.";
            }
            else
            {
                $checkImage = self::validateImage($img,$img_name);
                if (!$checkImage)
                {
                    echo "  Check your image type!";
                }
                else
                {
                    //connect database
                    $conn = new \UserIconRepository(self::getDB());
                    // check if user already exists in database
                    $checkUser = $conn->getAUser($userId);
                    if (!empty($checkUser))
                    {
                        return "User ID already exists! ";
                    }
                    else
                    {
                        //call constructor fra UserIcon, derefter insert det i database.
                        $inputUser = new \UserIcon($userId, $fname, $lname, $img_name);
                        $conn->create($inputUser); // create a user
                        return "Successfully created!";
                    }
                }
            }
        }
        else
        {
            return "You need to login or register! ";
        }
    }
}