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
                <h2>Brak list do usunięcia</h2>
                <a href="../main/main.php"><button type="submit" class="button">Powrót</button></a>
        </div>
    </div>