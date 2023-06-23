<?php  
include "../login/login_cookie.php";
include "head.php";
 
?>
<body>
    <div class="container">
    <?php
    include "design.html";
    include "../login/logoutbutton.html";
    ?>

        <div class="c3 logs">
            <h2>Zarządzanie listami</h2>
            <button type="submit" class="buttonex" onclick="window.location.href = '../creator/create.php'">Stwórz!</button><br>
            <button type="submit" class="buttonex" onclick="window.location.href = '../creator/choose_show.php'">Pokaż!</button><br>
            <button type="submit" class="buttonex" onclick="window.location.href = '../creator/choose_edit.php'">Zmień!</button><br>
            <button type="submit" class="buttonex" onclick="window.location.href = '../creator/delete.php'">Usuń!</button>
        </div>
        
    </div>
    
</body>