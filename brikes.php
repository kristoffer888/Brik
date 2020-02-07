<?php
include 'DBCon.php';

$selectB = function($color, $navn, $param) use($connect) {
    ?>
    <div class="col-lg-2" style="padding: 0; background-color: <?php echo $color; ?>">
        <div id="overskrift">
            <h2> <?php echo $navn ?></h2>
        </div>
        <?php
        $sql_tabel = "SELECT * FROM user_icons WHERE status='$param'";
        $data = mysqli_query($connect, $sql_tabel);
        $datacheck = mysqli_num_rows($data);

        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {

                echo '<div class="img-container">';

                if (strlen($row['billede']) > 0) {
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



    $selectB("whitesmoke", "Zone 5", 1);

    $selectB("lightgrey", "Zone 6", 2);

    $selectB("whitesmoke", "Programmører", 3);

    $selectB("lightgrey", "Serverrum", 4);

    $selectB("whitesmoke", "Helpdesk", 5);

    $selectB("lightgrey", "Ekstern", 6);
    