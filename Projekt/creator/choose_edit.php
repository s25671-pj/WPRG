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
        <div class="c3 logs">
            <h2>Edytuj listę</h2>
    <?php

// Odczytaj dane z pliku CSV
$filename = 'saved_lists.csv';

// Otwórz plik w trybie do odczytu
$file = fopen($filename, 'r');

// Tablica do przechowywania dostępnych list
$available_lists = array();

// Przejdź przez każdą linię w pliku CSV
while (($row = fgetcsv($file)) !== false) {
    $usernameFromFile = $row[0]; 
    $list_name = $row[1]; 

    // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
    // i dodaj nazwę listy do tablicy dostępnych list
    if ($usernameFromFile === $username && !in_array($list_name, $available_lists)) {
        $available_lists[] = $list_name;
    }
}

fclose($file);

// Wyświetl buttony dla dostępnych list
if (!empty($available_lists)) {
    echo '<form method="POST" action="edit.php">';
    echo '<select name="selected_list" class="select">';
    foreach ($available_lists as $list) {
    echo '<option value="' . $list . '">' . $list . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" class="button" value="Wybierz">';
    echo '</form>';
    
} else {
    echo '<p>Brak dostępnych list zakupów.</p>';
}
?>
<br>
<a href="../creator/create.php"><button type="submit" class="button">Stwórz listę</button></a>
        </div>
    </div>


</body>
</html>
