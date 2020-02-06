<?php
include 'DBCon.php';

$selectB = function($color, $navn, $param) use($connect) {
    ?>
    <div class="col-lg-2" style="padding: 0; background-color: <?php echo $color; ?>">
        <div id="overskrift">
            <h2> <?php echo $navn ?></h2>
        </div>
        <?php
        $sql_tabel = "SELECT * FROM login WHERE status='$param'";
        $data = mysqli_query($connect, $sql_tabel);
        $datacheck = mysqli_num_rows($data);

        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {

                echo '<div class="img-container">';

                if (strlen($row['billede']) > 0) {
                    //echo '<img src="data:images/png;base64,' . base64_encode($blob) . '" alt="' . $row['username'] . '" title="' . $row['username'] . '" class="img" style="width=100%"/>';
                    echo '<img src="' . $row['billede'] . '" alt="' . $row['username'] . '" title="' . $row['username'] . '" class="img" style="width=100%"/>';
                } else {
                    echo '<img src="images/kristoffer.png" alt="' . $row['username'] . '" title="' . $row['username'] . '" class="img" style="width=100%"/>';
                }
                echo '</div>';
            }
        }
        echo '</div>';
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
                <!--<a href='dashboard.php'><button>Tilbage</button></a>-->
                <div class="row" id="content">

                    <?php
                    $selectB("whitesmoke", "Zone5", 1);

                    $selectB("lightgrey", "Zone6", 2);

                    $selectB("whitesmoke", "Programmører", 3);

                    $selectB("lightgrey", "Serverrum", 4);

                    $selectB("whitesmoke", "Helpdesk", 5);

                    $selectB("lightgrey", "Ekstern", 6);
                    ?>

                </div>
                <script>
                    const interval = setInterval(function () {
                        $('#content').load("brikes.php");
                    }, 2000);
                </script>
            </div>
        </body>
    </html>
