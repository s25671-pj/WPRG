<?php
            $selected_list = isset($_POST['selected_list']) ? $_POST['selected_list'] : '';

            // Definicja tablicy $produkty
            $produkty = array("Awokado", "Banan", "Brokuł", "Cebula", "Chleb", "Cytryna", "Jabłko", "Kalafior", "Kasza", "Marchew", "Migdał", "Mleko", "Ogórek", "Orzechy", "Płatki śniadaniowe", "Pomarańcz", "Pomidor", "Papryka", "Ryż", "Sałata", "Sok", "Stek", "Truskawka", "Woda", "Ziemniaki");

            // Odczytaj dane z pliku CSV
            $filename = 'saved_lists.csv';

            // Otwórz plik w trybie do odczytu
            $file = fopen($filename, 'r');

            // Zmienna do przechowywania danych wybranej listy
            $list_data = array();

            // Przejdź przez każdą linię w pliku CSV
            while (($row = fgetcsv($file)) !== false) {
                $username = $row[0]; // Użytkownik
                $list_name = $row[1]; // Nazwa listy zakupów

                // Sprawdź, czy nazwa użytkownika zgadza się z aktualnie zalogowanym użytkownikiem
                // i czy nazwa listy zgadza się z wybraną przez użytkownika
                if ($username === $_SESSION['username'] && $list_name === $selected_list) {
                    // Pobierz resztę wartości dla danej listy
                    $list_data = array_slice($row, 2); // Ignoruj pierwsze dwie kolumny (Użytkownik, Nazwa listy zakupów)
                    break; // Znaleziono pasującą listę, przerwij pętlę
                }
            }
            ?>