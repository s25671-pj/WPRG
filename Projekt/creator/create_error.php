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
                <h2>Lista o podanej nazwie istnieje</h2>
                <a href="../creator/create.php"><button type="submit" class="button">Stwórz listę</button></a>
        </div>
    </div>