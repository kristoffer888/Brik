<?php
session_start();

include 'DBCon.php';

if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit;
}

$zones = function($param) use($connect, $servername, $username, $password, $databasename) {
    $u = $_SESSION ['username'];
    $p = $_SESSION ['password'];

    $connect = mysqli_connect($servername, $username, $password, $databasename);
    if (!$connect) {
        die("Connectiuon failed because" . mysqli_connect_error());
    }
    $sql_tabel = "UPDATE login SET status='$param' WHERE username='$u' AND password='$p'";

    $data = mysqli_query($connect, $sql_tabel);
    mysqli_close($connect);
};

if (isset($_POST["zzz"])) {
    $zones($_POST["zzz"]);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="resetstyelsheet.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <title>Dashboard</title>
    </head>
    <body>
        <header>
            <nav>
                <!--<p class="logo">IT&DATA - SKP</p>-->
                <ul>
                    <li><p>IT&DATA - SKP</p></li>
                    <!--<li><a href="#">Historik</a></li>-->
                    <li class="navbar-float-right-element">
                        <a href="index.php" class="logout-butten">Log ud</a>
                    </li>
                    <li class="navbar-float-right-element">
                        <button class="username-text"name="" type="button">Profil:
                            <?php
                            echo $_SESSION ['username'];
                            ?>
                        </button>
                    </li><!--Ved ikke om det skal forblive en knap, ikke grund til det?-->
                    <li class="navbar-float-right-element">
                        <a href="screen.php" class="logout-butten" >Brikskærm</a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div id="zone-container-button">
                <form method="POST">
                    <button class="user-button-zone-panel" name="zzz" value="1" type="submit">Zone 5</button>
                    <button class="user-button-zone-panel" name="zzz" value="2" type="submit">Zone 6</button>
                    <button class="user-button-zone-panel" name="zzz" value="3" type="submit">Programmør</button>
                    <button class="user-button-zone-panel" name="zzz" value="4" type="submit">Serverrum</button>
                    <button class="user-button-zone-panel" name="zzz" value="5" type="submit">Helpdesk</button>
                    <button class="user-button-zone-panel" name="zzz" value="6" type="submit">Ekstern</button>
                    <button class="user-button-zone-panel" name="zzz" value="7" type="submit">Fri</button>
                    <button class="user-button-zone-panel" name="zzz" value="8" type="submit">Gået Hjem</button>
                    <!-- <button class="user-button-zone-panel" name="hjem" type="submit">HF IT-Support/Infra</button>
                    <button class="user-button-zone-panel" name="hjem" type="submit">HF Programm&#248;r</button>-->
                </form>
            </div>

            <?php
//var_dump($_SESSION);
            ?>

        </main>
    </body>
</html>



