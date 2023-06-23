<?php
function countListElements($listName) {
    // Odczytaj dane z pliku CSV
    $filename = 'saved_lists.csv';

    // Otwórz plik w trybie do odczytu
    $file = fopen($filename, 'r');

    // Zmienna do przechowywania liczby elementów w liście
    $elementCount = 0;

    // Przejdź przez każdą linię w pliku CSV
    while (($row = fgetcsv($file)) !== false) {
        $username = $row[0]; // Użytkownik
        $list_name = $row[1]; // Nazwa listy zakupów

        // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
        // i czy nazwa listy zgadza się z przekazaną nazwą listy
        if ($username === $_SESSION['username'] && $list_name === $listName) {
            // Pobierz resztę wartości dla danej listy
            $list_data = array_slice($row, 2); // Ignoruj pierwsze dwie kolumny (Użytkownik, Nazwa listy zakupów)
            $elementCount = count(array_filter($list_data, function($value) {
                return $value > 0; // Zlicz tylko wartości większe od zera
            }));
            break; // Znaleziono pasującą listę, przerwij pętlę
        }
    }

    fclose($file);

    return $elementCount;
}
?>