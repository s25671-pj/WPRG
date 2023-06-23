<?php
ob_start();
include "../login/login_cookie.php";
include "../main/head.php";
?>

<body>
    <div class="container">
        <?php
        include "../main/design.html";
        include "../login/logoutbutton.html";
        include "search.php";

        // Otwórz plik w trybie do odczytu
        $file = fopen($filename, 'r');

        // Odczytaj nagłówki kolumn z pliku
        $column_names = fgetcsv($file);

        // Wczytaj resztę danych do tablicy
        $lines = [];
        while (($row = fgetcsv($file)) !== false) {
            $lines[] = $row;
        }

        // Zamknij plik
        fclose($file);
        ?>
   
            <div class="a1">
                <h1>Edytuj listę</h1>
            </div>
            
                <div class="b1">
                <form action="" method="post">
                <input type="hidden" name="selected_list" value="<?php echo $selected_list; ?>">
                    <input type="text" class="inputXL" id="list_name" name="list_name" value="<?php echo $selected_list; ?>">
                </div>
                <div class="a2 choose">
                    <?php
                    foreach ($produkty as $index => $product_name) {
                        $value = isset($list_data[$index]) ? $list_data[$index] : 0;
                        if ($index < 5) {
                        echo '<div class="product-input">';
                        echo '<label class="labelRight" for="product' . $index . '">' . $product_name . ':</label>';
                        echo '<input class="input" type="number" id="product' . $index . '" name="list_data[' . $index . ']" value="' . $value . '">';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="b2 choose">
                    <?php
                    foreach ($produkty as $index => $product_name) {
                        $value = isset($list_data[$index]) ? $list_data[$index] : 0;
                        if ($index >= 5 && $index < 10) {
                        echo '<div class="product-input">';
                        echo '<label class="labelRight" for="product' . $index . '">' . $product_name . ':</label>';
                        echo '<input class="input" type="number" id="product' . $index . '" name="list_data[' . $index . ']" value="' . $value . '">';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="c2 choose">
                    <?php
                    foreach ($produkty as $index => $product_name) {
                        $value = isset($list_data[$index]) ? $list_data[$index] : 0;
                        if ($index >= 10 && $index < 15) {
                        echo '<div class="product-input">';
                        echo '<label class="labelRight" for="product' . $index . '">' . $product_name . ':</label>';
                        echo '<input class="input" type="number" id="product' . $index . '" name="list_data[' . $index . ']" value="' . $value . '">';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="d2 choose">
                    <?php
                    foreach ($produkty as $index => $product_name) {
                        $value = isset($list_data[$index]) ? $list_data[$index] : 0;
                        if ($index >= 15 && $index < 20) {
                        echo '<div class="product-input">';
                        echo '<label class="labelRight" for="product' . $index . '">' . $product_name . ':</label>';
                        echo '<input class="input" type="number" id="product' . $index . '" name="list_data[' . $index . ']" value="' . $value . '">';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="e2 choose">
                    <?php
                    foreach ($produkty as $index => $product_name) {
                        $value = isset($list_data[$index]) ? $list_data[$index] : 0;
                        if ($index >= 20) {
                        echo '<div class="product-input">';
                        echo '<label class="labelRight" for="product' . $index . '">' . $product_name . ':</label>';
                        echo '<input class="input" type="number" id="product' . $index . '" name="list_data[' . $index . ']" value="' . $value . '">';
                        echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="c4">
                    <a href="choose_show.php"><button type="submit" class="button">Zapisz zmiany</button></a>
                </div>
            </form>
        

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sprawdź, czy przesłano formularz edycji
            $selected_list = isset($_POST['selected_list']) ? $_POST['selected_list'] : '';
            $new_list_name = isset($_POST['list_name']) ? $_POST['list_name'] : '';
            $new_list_data = isset($_POST['list_data']) ? $_POST['list_data'] : [];

            if (!empty($selected_list) && !empty($new_list_name)) {
                // Zaktualizuj dane w tablicy
                foreach ($lines as &$row) {
                    $username = $row[0]; // Użytkownik
                    $list_name = $row[1]; // Nazwa listy zakupów

                    if ($username === $_SESSION['username'] && $list_name === $selected_list) {
                        // Zaktualizuj nazwę listy
                        $row[1] = $new_list_name;
                        // Zaktualizuj wartości liczbowe dla produktów
                        foreach ($new_list_data as $index => $value) {
                            $row[$index + 2] = $value;
                        }
                    }
                }

                // Otwórz plik w trybie do zapisu
                $file = fopen($filename, 'w');

                // Zapisz nagłówki kolumn
                fputcsv($file, $column_names);

                // Zapisz zaktualizowane dane
                foreach ($lines as $line) {
                    fputcsv($file, $line);
                }

                // Zamknij plik
                fclose($file);
                header('Location: choose_show.php');
                ob_end_flush();
                exit;
            }
        }
        ?>
    </div>
</body>

</html>
