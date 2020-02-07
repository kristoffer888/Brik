<?php
session_start();
//session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="resetstyelsheet.css">
        <link rel="stylesheet" type="text/css" href="logincss.css">
        <title>Login</title>
    </head>
    <body>
        <main>
            <p class="login-overskrift-text">Login formular</p>
            <div id="login-container">
                <div id="login-form">
                    <p>Log ind for at starte din session</p>
                    <form action="loginconfirm.php" method="POST">
                        <input type="text" name="username" class="login-user-input-box" placeholder="Indtast din e-mail adresse">
                        <input type="password" name="password" class="login-user-input-box" placeholder="Adgangskode"><br/>
                        <input type="submit" class="login-button" value="Log p&#229;">
                        <a href="https://itd-skp.sde.dk/index.php" class="login-itd-skp">Log ind p&#229; ITD-SKP</a>
                    </form> 
                </div>
            </div>
        </main>
    </body>
</html>