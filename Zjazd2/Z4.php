<!DOCTYPE html>
<html>

<head>
    <title>Czy liczba pierwsza</title>
</head>

<body>
    <form method="POST">
        <label>Podaj liczbę:</label>
        <input type="number" name="liczba" required>
        <input type="submit" value="Sprawdź">
    </form>
    <?php
    function czy_liczba_pierwsza($liczba, &$iteracje) {
        if ($liczba < 2) {
            return false;
        }
        
        for ($i = 2; $i <= sqrt($liczba); $i++) {
            $iteracje++;
            if ($liczba % $i === 0) {
                return false;
            }
        }
        
        return true;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $liczba = $_POST["liczba"];
        
        if (is_numeric($liczba) && $liczba > 0 && intval($liczba) == $liczba) {
            $iteracje = 1;
            $czy_pierwsza = czy_liczba_pierwsza($liczba, $iteracje);
            
            if ($czy_pierwsza) {
                echo "<p>Liczba $liczba jest liczbą pierwszą.</p>";
            } else {
                echo "<p>Liczba $liczba nie jest liczbą pierwszą.</p>";
            }
            
            echo "<p>Ilość iteracji: $iteracje</p>";
        } else {
            echo "<p>Podana wartość nie jest poprawną liczbą całkowitą dodatnią.</p>";
        }
    }
?>
</body>
</html>