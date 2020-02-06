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
                <ul>
                    <li><p>IT&DATA - SKP</p></li>
                    <li class="navbar-float-right-element">
                        <a href="index.php" class="logout-butten">Log ud</a>
                    </li>
                    <li class="navbar-float-right-element">
                        <button class="username-text"name="" type="button">Profil:
                            <?php
                            echo $_SESSION ['username'];
                            ?>
                        </button>&nbsp; &nbsp;
                        <button class="location-text"name="" type="button">Location:
                            <?php
                            $u = $_SESSION ['username'];
                            $p = $_SESSION ['password'];

                            $sql_tabel = "SELECT * FROM login WHERE username='$u' AND password='$p'";
                            $data = mysqli_query($connect, $sql_tabel);
                            $datacheck = mysqli_num_rows($data);

                            if ($data) {
                                while ($row = mysqli_fetch_assoc($data)) {
                                    switch ($row['status']) {
                                        case 1:
                                            echo 'Zone 5';
                                            break;
                                        case 2:
                                            echo 'Zone 6';
                                            break;
                                        case 3:
                                            echo 'Programmører';
                                            break;
                                        case 4:
                                            echo 'Serverrum';
                                            break;
                                        case 5:
                                            echo 'Helpdesk';
                                            break;
                                        case 6:
                                            echo 'Ekstern';
                                            break;
                                        case 7:
                                            echo 'Fri';
                                            break;
                                        case 8:
                                            echo 'Gået Hjem';
                                            break;
                                        case 9:
                                            echo 'HF: IT-Support/Infra';
                                            break;
                                        case 10:
                                            echo 'HF: Programmører';
                                            break;
                                        case 11:
                                            echo 'Syg';
                                            break;
                                        default:
                                            echo 'Error';
                                            break;
                                    }
                                    $status = $row['status'];
                                }
                            }
                            ?>

                        </button>
                    </li><!--Ved ikke om det skal forblive en knap, ikke grund til det?-->
                </ul>
            </nav>
        </header>
    <center>
        <main>
            <div id="zone-container-button">
                <form method="POST">
                    <button class="user-button-zone-panel" name="zzz" value="1" id="1a" type="submit">Zone 5</button>
                    <button class="user-button-zone-panel" name="zzz" value="2" type="submit">Zone 6</button>
                    <button class="user-button-zone-panel" name="zzz" value="3" type="submit">Programmører</button>
                    <button class="user-button-zone-panel" name="zzz" value="4" type="submit">Serverrum</button>
                    <button class="user-button-zone-panel" name="zzz" value="5" type="submit">Helpdesk</button>
                    <button class="user-button-zone-panel" name="zzz" value="6" type="submit">Ekstern</button>
                    <button class="user-button-zone-panel" name="zzz" value="7" type="submit">Fridag</button>
                    <button class="user-button-zone-panel" name="zzz" value="8" type="submit">Check ud</button>
                    <button class="user-button-zone-panel" name="zzz" value="9" type="submit">HF: Supp/Infr</button>
                    <button class="user-button-zone-panel" name="zzz" value="10" type="submit">HF: Prog</button>
                </form>
            </div>
        </main>
    </center>

    <script>
        var status = "<?php echo $status; ?>";

        function showresults(value) {
            if (value.value === status) {
                value.style.backgroundColor = "#1c993d";
                value.style.color = "whitesmoke";
                value.style.border = "1px solid #484848";
            }
        }

        var input = document.getElementsByName("zzz");
        var inputlist = Array.prototype.slice.call(input);
        inputlist.forEach(showresults);
    </script>
</body>
</html>



