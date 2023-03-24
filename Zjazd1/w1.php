    <?php

    echo ("### 1.1 ###</br></br>");
    echo ("Witaj w świecie PHP!!!</br></br>");
    echo ("### 1.2 ###</br></br>");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['a']) && isset($_POST['b'])) {
        $a = $_POST['a'];
        $b = $_POST['b'];

        if ($a <= 0 || $b <= 0) {
          echo "Wartości muszą być dodatnie";
        } else {
          $pole = $a * $b;
          echo "Pole prostokąta o bokach $a i $b wynosi: $pole";
        }
      }
    }
    ?>

    <form method="post" action="">
      <label>Bok a:</label>
      <input type="number" name="a"><br>
      <label>Bok b:</label>
      <input type="number" name="b"><br>
      <input type="submit" value="Oblicz pole">
    </form>
    <br>

    <?php
    echo ("### 1.3 ###</br></br>");

    $c = pi();
    $c = sqrt($c);
    $c = round($c, 2);

    echo ($c);
    echo ("</br></br>### 1.4 ###</br></br>");

    ?>

    <br>
    <form method="post" action="">
      <label>Podaj pierwszą liczbę:</label>
      <input type="number" name="d"><br>
      <label>Podaj drugą liczbę:</label>
      <input type="number" name="e"><br>
      <input type="submit" value="Oblicz">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['d']) && isset($_POST['e'])) {
        $d = $_POST['d'];
        $e = $_POST['e'];


        $dodawanie = $d + $e;
        $odejmowanie = $d - $e;
        if ($d == 0 || $e == 0) {
          echo "Nie można obliczyć wyniku mnożenia, dzielenia, modulo dla wartości 0";
        } else {
          $mnozenie = $d * $e;
          $dzielenie = $d / $e;
          $modulo = $d % $e;

          echo "Dla podanych liczb: " . $d . " i " . $e . "</br> Dodawanie: " . $dodawanie;
          echo "</br> Odejmowanie: " . $odejmowanie . "</br> Mnożenie: " . $mnozenie;
          echo "</br> Dzielenie: " . $dzielenie . "</br> Modulo: " . $modulo . "</br>";
        }
      }
    }
    echo "</br>### 1.5 ###";
    ?>
    <br><br>

    <form method="post" action="">
      <label>Wpisz dwa napisy (oddzielone spacją):</label>
      <input type="text" name="f"><br>
      <input type="submit" value="Wyślij">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['f'])) {
        $f = explode(" ", $_POST['f']);
        if (count($f) != 2) {
          echo "Niepoprawny format danych!";
        } else {
          $napis1 = $f[0];
          $napis2 = $f[1];
          echo "%$napis2 $napis1%#";
        }
      }
    }
    ?>
    <br>

    <?php
    echo "### 1.6 ###</br></br>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['g']) && isset($_POST['h']) && isset($_POST['i'])) {
        $g = $_POST['g'];
        $h = $_POST['h'];
        $i = $_POST['i'];

        if ($g > 0 && $h > 0 && $i > 0 && $g + $h > $i && $g + $i > $h && $h + $i > $g) {
          echo "Można zbudować trójkąt.";
        } else {
          echo "BŁĄD: Nie można zbudować trójkąta.";
        }
      }
    }
    ?>

    <form method="post" action="">
      <label>Bok 1:</label>
      <input type="number" name="g"><br>
      <label>Bok 2:</label>
      <input type="number" name="h"><br>
      <label>Bok 3:</label>
      <input type="number" name="i"><br>
      <input type="submit" value="Sprawdź">
    </form>
    <br>
    <?php
    echo "### 1.7 ###</br></br>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['month'])) {
        $month = $_POST['month'];

        if ($month < 1 || $month > 12) {
          echo "BŁĄD: Podaj liczbę z zakresu 1-12!";
        } else {
          switch ($month) {
            case 1:
              echo "Miesiąc: Styczeń, Ilość dni: 31";
              break;
            case 2:
              echo "Miesiąc: Luty, Ilość dni: 28";
              break;
            case 3:
              echo "Miesiąc: Marzec, Ilość dni: 31";
              break;
            case 4:
              echo "Miesiąc: Kwiecień, Ilość dni: 30";
              break;
            case 5:
              echo "Miesiąc: Maj, Ilość dni: 31";
              break;
            case 6:
              echo "Miesiąc: Czerwiec, Ilość dni: 30";
              break;
            case 7:
              echo "Miesiąc: Lipiec, Ilość dni: 31";
              break;
            case 8:
              echo "Miesiąc: Sierpień, Ilość dni: 31";
              break;
            case 9:
              echo "Miesiąc: Wrzesień, Ilość dni: 30";
              break;
            case 10:
              echo "Miesiąc: Październik, Ilość dni: 31";
              break;
            case 11:
              echo "Miesiąc: Listopad, Ilość dni: 30";
              break;
            case 12:
              echo "Miesiąc: Grudzień, Ilość dni: 31";
              break;
          }
        }
      }
    }
    ?>

    <form method="post" action="">
      <label>Podaj liczbę z zakresu 1-12:</label>
      <input type="number" name="month"><br>
      <input type="submit" value="Sprawdź">
    </form>
    <br>

    <?php
    echo "### 1.8 ###</br></br>";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['j']) && isset($_POST['k']) && isset($_POST['l'])) {
        $j = floatval($_POST['j']);
        $k = floatval($_POST['k']);
        $l = floatval($_POST['l']);
        echo "Liczby w kolejności od najmniejszej do największej: ";
        if ($j <= $k && $j <= $l) {
          echo $j . " ";
          if ($k <= $l) {
            echo $k . " " . $l . "<br>";
          } else {
            echo $l . " " . $k . "<br>";
          }
        } else if ($k <= $j && $k <= $l) {
          echo $k . " ";
          if ($j <= $l) {
            echo $j . " " . $l . "<br>";
          } else {
            echo $l . " " . $j . "<br>";
          }
        } else {
          echo $l . " ";
          if ($j <= $k) {
            echo $j . " " . $k . "<br>";
          } else {
            echo $k . " " . $j . "<br>";
          }
        }
        echo "Liczby w kolejności od największej do najmniejszej: ";
        if ($j >= $k && $j >= $l) {
          echo $j . " ";
          if ($k >= $l) {
            echo $k . " " . $l . "<br>";
          } else {
            echo $l . " " . $k . "<br>";
          }
        } else if ($k >= $j && $k >= $l) {
          echo $k . " ";
          if ($j >= $l) {
            echo $j . " " . $l . "<br>";
          } else {
            echo $l . " " . $j . "<br>";
          }
        } else {
          echo $l . " ";
          if ($j >= $k) {
            echo $j . " " . $k . "<br>";
          } else {
            echo $k . " " . $j . "<br>";
          }
        }
      }
    }
    ?>
    <form method="post">
      <label>Podaj pierwszą liczbę:</label>
      <input type="text" name="j"><br>
      <label>Podaj drugą liczbę:</label>
      <input type="text" name="k"><br>
      <label>Podaj trzecią liczbę:</label>
      <input type="text" name="l"><br>
      <input type="submit" value="Sortuj">
    </form>
    <br>
    <p>### 1.9 ###</p>
    <form method="post">
      <fieldset>
        <legend>Wprowadź wartości dla dwóch tablic 3-elementowych:</legend>
        <label for="arr1">Tablica 1:</label><br>
        <input type="number" name="arr1[]" id="arr1_0">
        <input type="number" name="arr1[]" id="arr1_1">
        <input type="number" name="arr1[]" id="arr1_2">
        <br>
        <label for="arr2">Tablica 2:</label><br>
        <input type="number" name="arr2[]" id="arr2_0">
        <input type="number" name="arr2[]" id="arr2_1">
        <input type="number" name="arr2[]" id="arr2_2">
        <br><br>
        <input type="submit" value="Oblicz">
      </fieldset>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['arr1']) && isset($_POST['arr2'])) {
        if (count($_POST['arr1']) !== 3 || count($_POST['arr2']) !== 3) {

          echo "BŁĄD: Wymagane są dwie tablice 3-elementowe.";
          exit();
        }

        $arr1 = array_map('intval', $_POST['arr1']);
        $arr2 = array_map('intval', $_POST['arr2']);

        $sumArr = 0;
        for ($i = 0; $i < 3; $i++) {
          $sumArr += $arr1[$i] * $arr2[$i];
        }

        echo "<p>Iloczyn skalarny dwóch tablic wynosi: " . $sumArr . "</p>";
      }
    }
    ?>
    <br>
    <p>### 1.10 ###</p>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['o'])) {
        $o = intval($_POST["o"]);
        if ($o > 0) {

          for ($i = 1; $i <= $o; $i++) {
            for ($j = 1; $j <= $i; $j++) {
              echo "*";
            }
            echo "</br>";
          }

          for ($i = $o; $i >= 1; $i--) {
            for ($j = 1; $j <= $i; $j++) {
              echo "*";
            }
            echo "</br>";
          }

          for ($i = 1; $i <= $o; $i++) {
            for ($j = 1; $j <= $i - 1; $j++) {
              echo "&nbsp;";
              echo "&nbsp;";
            }
            for ($j = $i; $j <= $o; $j++) {
              echo "*";
            }
            echo "</br>";
          }
          for ($i = $o; $i >= 1; $i--) {
            for ($j = 2; $j <= $i; $j++) {
              echo "&nbsp;";
              echo "&nbsp;";
            }
            for ($j = $i; $j <= $o; $j++) {
              echo "*";
            }
            echo "</br>";
          }
        } else {
          echo "BŁĄD: Podana liczba musi być większa od zera!";
        }
      }
    }
    ?>

    <form method="post">
      <label for="o">Podaj liczbę naturalną: </label>
      <input type="number" id="o" name="o" min="1"><br><br>
      <input type="submit" value="Wyślij">
    </form>