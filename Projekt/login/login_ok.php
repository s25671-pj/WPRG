<?php
include "../login/login_cookie.php";
include "../main/head.php";
?>

<body>
    <div class="container">
        <?php
        include "../main/design.html";
        include "../login/logoutbutton.html";
        ?>
        <div class="logs c3">
                <h2>Zalogowano</h2>
                <a href="../main/main.php"><button type="submit" class="button">Dalej</button></a>
        </div>
    </div>