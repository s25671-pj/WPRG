<?php
include "../login/login_cookie.php";
include "../main/head.php";
?>

<body>
    <div class="container">
        <?php
        include "../main/design.html";
        include "../login/logoutbutton.html";
        include "search.php";
        include "fun_count.php";
        $count = countListElements($list_name);

        // Zamknij plik
        fclose($file);
        ?>

        <div class="b3 logs">
            <h1>Nazwa listy: <?php echo $selected_list; ?></h1>
            <br>
            <h3>Łącznie różnych pozycji: <?php echo $count; ?></h3>
        </div>
        <div class="c3 logs">
            <?php
            if (!empty($list_data)) {
                $count = count($list_data);
                $limit = 13;

                if ($count <= $limit) {
                    foreach ($list_data as $index => $value) {
                        $product_name = $produkty[$index]; // Pobierz nazwę produktu z tablicy $produkty
                        if ($value > 0) {
                            echo $product_name . ': ' . $value . '</br>';
                        }
                    }
                } else {
                    $c3_list = array_slice($list_data, 0, $limit);
                    $d3_list = array_slice($list_data, $limit);

                    foreach ($c3_list as $index => $value) {
                        $product_name = $produkty[$index]; // Pobierz nazwę produktu z tablicy $produkty
                        if ($value > 0) {
                            echo $product_name . ': ' . $value . '</br>';
                        }
                    }

                    echo '</div>'; // Zamknięcie <div class="c3">
                    echo '<div class="d3 logs">';

                    foreach ($d3_list as $index => $value) {
                        $adjustrd_index = $index + $limit;
                        $product_name = $produkty[$adjustrd_index]; // Pobierz nazwę produktu z tablicy $produkty
                        if ($value > 0) {
                            echo $product_name . ': ' . $value . '</br>';
                        }
                    }
                }
            } else {
                echo '<p>Brak danych dla wybranej listy.</p>';
            }
            ?>
        </div>
        <div class="b4"><a href="../creator/choose_show.php"><button type="submit" class="button">Wybierz inną listę</button></a></div>


    </div>

</body>

</html>