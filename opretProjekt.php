<?php
ob_start();
session_start();
?>
<main>
    <form action="opret.php" method="post" enctype="multipart/form-data" style="padding-left: 16px; padding-top: 16px;">
        FullName:
        <input type="text" name="fullname"><br>
        Username:
        <input type="text" name="username"><br>
        Password:
        <input type="password" name="password" min="0"><br>
        Status:
        <input type="number" name="status"><br>
        Image:
        <input type="file" name="billede" id="billede"><br><br>
        <input type="submit" value="Tilføj" name="GEM">
    </form>
</main>