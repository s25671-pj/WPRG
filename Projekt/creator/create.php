<?php
include "../login/login_cookie.php";
include "../main/head.php";

// Sprawdź, czy dane zostały przesłane
if (isset($_POST['zapisz'])) {

    $nazwa_listy = $_POST['nazwa_listy'];
    $wybrane_produkty = isset($_POST['produkty']) ? $_POST['produkty'] : array();

    $username = $_SESSION['username'];

    $nazwa_listy_dubel = false; // Zmienna przechowująca informację o duplikacie nazwy listy

    $username = $_SESSION['username'];
    
    $filename = 'saved_lists.csv';
    // Otwórz plik w trybie do odczytu
    $file = fopen($filename, 'r');
    
    // Zmienna przechowująca informację o istnieniu listy
    $list_exists = false;
    
    // Przejdź przez każdą linię w pliku CSV
    while (($row = fgetcsv($file)) !== false) {
        $row_username = $row[0]; // Użytkownik
        $row_list_name = $row[1]; // Nazwa listy zakupów
    
        // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
        // i czy nazwa listy zgadza się z nową nazwą listy
        if ($row_username === $username && $row_list_name === $nazwa_listy) {
            $list_exists = true;
            break; // Znaleziono istniejącą listę, przerwij pętlę
        }
    }
    
    // Zamknij plik
    fclose($file);
    
    if ($list_exists) {
        header("Location: create_error.php");
        exit;
    } else {
    
        // Zapisz listę zakupów do pliku CSV
        $filename = 'saved_lists.csv';
    
        // Otwórz plik w trybie dodawania do zapisu
        $file = fopen($filename, 'a');
    
        // Sprawdź, czy plik jest pusty
        $is_empty = filesize($filename) === 0;
    
        // Utwórz wiersz danych
        $row = array('Użytkownik' => $username, 'Nazwa listy zakupów' => $nazwa_listy);
    
        // Dodaj wybrane produkty do wiersza danych
        foreach ($wybrane_produkty as $produkt => $liczba) {
            $row[$produkt] = $liczba;
        }
    
        // Jeśli plik jest pusty, zapisz nagłówek
        if ($is_empty) {
            fputcsv($file, array_keys($row));
        }
    
        // Zapisz wiersz danych do pliku
        fputcsv($file, $row);
    
        fclose($file);
    
        header('Location: saved.php');
        exit;
    }
}
    ?>
    
<body>
    <div class="container">
        <?php
        include "../main/design.html";
        include "../login/logoutbutton.html";
        ?>
        <div class="a1">
            <h1>Podaj nazwę listy:</h1>
        </div>
        <div class="b1">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="nazwa_listy" class="inputXL" required>
        </div>
        <div class="messRight">
            <h1>Wybierz produkty, które chcesz dodać do listy:</h1><br>
        </div>
        <div class="e1"></div>
        <div class="a2 choose">
            <?php
            $produkty = array(
                "Awokado", "Banan", "Brokuł", "Cebula", "Chleb", "Cytryna", "Jabłko",
                "Kalafior", "Kasza", "Marchew", "Migdał", "Mleko", "Ogórek", "Orzechy",
                "Płatki śniadaniowe", "Pomarańcz", "Pomidor", "Papryka", "Ryż", "Sałata",
                "Sok", "Stek", "Truskawka", "Woda", "Ziemniaki"
            );

            foreach ($produkty as $index => $produkt) {
                if ($index < 5) {
                    echo '<label class="labelRight">' . $produkt . '</label>';
                    echo '<input class="input" type="number" name="produkty[' . $produkt . ']" min="0"><br>';
                }
            }
            ?>
        </div>
        <div class="b2 choose">
            <?php
            foreach ($produkty as $index => $produkt) {
                if ($index >= 5 && $index < 10) {
                    echo '<label class="labelRight">' . $produkt . '</label>';
                    echo '<input class="input" type="number" name="produkty[' . $produkt . ']" min="0"><br>';
                }
            }
            ?>
        </div>
        <div class="c2 choose">
            <?php
            foreach ($produkty as $index => $produkt) {
                if ($index >= 10 && $index < 15) {
                    echo '<label class="labelRight">' . $produkt . '</label>';
                    echo '<input class="input" type="number" name="produkty[' . $produkt . ']" min="0"><br>';
                }
            }
            ?>
        </div>
        <div class="d2 choose">
            <?php
            foreach ($produkty as $index => $produkt) {
                if ($index >= 15 && $index < 20) {
                    echo '<label class="labelRight">' . $produkt . '</label>';
                    echo '<input class="input" type="number" name="produkty[' . $produkt . ']" min="0"><br>';
                }
            }
            ?>
        </div>
        <div class="e2 choose">
            <?php
            foreach ($produkty as $index => $produkt) {
                if ($index >= 20) {
                    echo '<label class="labelRight">' . $produkt . '</label>';
                    echo '<input class="input" type="number" name="produkty[' . $produkt . ']" min="0"><br>';
                }
            }
            ?>
        </div>
        <div class="a3"></div>
        <div class="b3"></div>
        <div class="c3"></div>
        <div class="d3"></div>
        <div class="a4"></div>
        <div class="b4"></div>
        <div class="c4">
            <input type="submit" name="zapisz" class="button" value="Zapisz">
        </div>
        </form>
    </div>
</body>

</html>