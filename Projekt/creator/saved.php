<?php
session_start();
include "../main/head.php";
?>

<body>
    <div class="container">
        <?php
        include "../main/design.html";
        include "../login/logoutbutton.html";
        ?>
        <div class="logs c3">
                <h2>Lista zapisana</h2>
                <a href="../creator/choose_show.php"><button type="submit" class="button">Wybierz listę</button></a>
        </div>
    </div>