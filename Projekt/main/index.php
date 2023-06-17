<?php  
include "head.php"; 
?>
<body>
    <div class="container">
    <?php
    include "design.php";
    ?>

        <div class="b3 logs">
            <h2>Rejestracja</h2>
            <button type="submit" class="button" onclick="window.location.href = '../register/register.php'">Zarejestruj!</button>
        </div>

        <div class="d3 logs">
            <h2>Logowanie</h2>
            <button type="submit" class="button" onclick="window.location.href = '../login/login.php'">Zaloguj!</button>
        </div>
        
    </div>
    
</body>