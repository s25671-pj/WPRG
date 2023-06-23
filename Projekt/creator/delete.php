<?php
include "../login/login_cookie.php";
include "../main/head.php";

// Sprawdź, czy została wybrana lista do usunięcia
if (isset($_POST['selected_list'])) {
    $selectedList = $_POST['selected_list'];

    // Otwórz plik saved_lists.csv
    $filename = 'saved_lists.csv';

    // Otwórz plik w trybie do odczytu
    $file = fopen($filename, 'r');

    // Inicjalizacja tablicy $listData
    $listData = array();

    // Przejdź przez każdą linię w pliku CSV
    while (($row = fgetcsv($file)) !== false) {
        $username = $row[0]; 
        $listName = $row[1]; 

        // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
        // i czy nazwa listy zgadza się z wybraną przez użytkownika
        if ($username === $_SESSION['username'] && $listName === $selectedList) {
            continue; // Pomijamy wpis, który ma zostać usunięty
        }

        $listData[] = $row; // Dodaj wpis do tablicy $listData
    }

    fclose($file);

    // Otwórz plik ponownie w trybie do zapisu
    $file = fopen($filename, 'w');

    // Zapisz listy zakupów do pliku CSV
    foreach ($listData as $row) {
        fputcsv($file, $row);
    }

    fclose($file);
}

// Otwórz plik saved_lists.csv
$filename = 'saved_lists.csv';

// Otwórz plik w trybie do odczytu
$file = fopen($filename, 'r');

// Inicjalizacja tablicy $listData
$listData = array();

// Przejdź przez każdą linię w pliku CSV
while (($row = fgetcsv($file)) !== false) {
    $username = $row[0]; // Użytkownik

    // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
    if ($username === $_SESSION['username']) {
        $listData[] = $row; // Dodaj listę do tablicy $listData
    }
}

fclose($file);

// Przekieruj na stronę delete_error.php, jeśli użytkownik nie ma żadnych list zakupów
if (count($listData) == 0) {
    header('Location: delete_error.php');
    exit;
}
?>

<body>
<div class="container">
    <?php
    include "../main/design.html";
    include "../login/logoutbutton.html";
    ?>
    <div class="c2 logs">
        <h1>Usuwanie listy zakupów</h1>
        <form method="post" action="">
            <label for="selected_list"><h3>Wybierz listę do usunięcia:</h3></label>
            <select name="selected_list" id="selected_list" class="select">
                <?php
                // Generuj opcje dla każdej listy zakupów
                foreach ($listData as $row) {
                    echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Usuń listę" class="button">
        </form>
    </div>
</div>
</body>
</html>
