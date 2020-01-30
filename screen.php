<?php
include 'DBCon.php';

$selectB = function($param) use($connect) {
    $sql_tabel = "SELECT * FROM login WHERE status='$param'";
    $data = mysqli_query($connect, $sql_tabel);
    $datacheck = mysqli_num_rows($data);

    if ($data) {
        while ($row = mysqli_fetch_assoc($data)) {
            echo '<div class="img-container">';
            echo "<img src='images/" . $row['billede'] . "' class='img' style='width=100%'>";
            echo '</div>';
        }
    }

    return $datacheck;
};
?>

<!DOCTYPE html>
<html lang="da">
    <head>
        <title>Screen</title>

        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <a href='dashboard.php'><button>Tilbage</button></a>
            <div class="row">

                <div class="col-lg-2" style="background-color: whitesmoke; padding: 0;">
                    <div id="overskrift">
                        <h2>Zone 5</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(1);
                    ?>
                </div>

                <div class="col-lg-2"style="background-color: lightgrey; padding: 0;">
                    <div id="overskrift">
                        <h2>Zone 6</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(2);
                    ?>
                </div>

                <div class="col-lg-2"style="background-color: whitesmoke; padding: 0;">
                    <div id="overskrift">
                        <h2>Programmør</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(3);
                    ?>
                </div>

                <div class="col-lg-2"style="background-color: lightgrey; padding: 0;">
                    <div id="overskrift">
                        <h2>Serverrum</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(4);
                    ?>
                </div>

                <div class="col-lg-2"style="background-color: whitesmoke; padding: 0;">
                    <div id="overskrift">
                        <h2>Helpdesk</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(5);
                    ?>
                </div>

                <div class="col-lg-2"style="background-color: lightgrey; padding: 0;">
                    <div id="overskrift">
                        <h2>Ekstern</h2>
                    </div>
                    <?php
                    $datacheck = $selectB(6);
                    ?>
                </div>

            </div>
        </div>
    </body>
</html>
