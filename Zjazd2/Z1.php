<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
</head>
<body>
    <h2>Kalkulator</h2>
    <p><i>Podaj liczby i wybierz typ obliczenia.</i></p>
    <form method="post">
        <label>Pierwsza liczba: </label><input type="number" name="a" required><br>
        <label>Druga liczba: </label><input type="number" name="b" required><br>
        <select id="selecto" name="selecto">
        <option value="add">Dodawanie</option>   
        <option value="sub">Odejmowanie</option>  
        <option value="mul">Mnożenie</option>  
        <option value="div">Dzielenie</option>  
    </select><br>
        <button type="submit">Oblicz!</button>
    </form>
    <br>
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['a']) && isset($_POST['b'])){
         $a = $_POST['a'];
         $b = $_POST['b'];
         $selecto = $_POST['selecto'];
        
         switch ($selecto){
            case "add":
                echo "Wynik: " . $a+$b;
                break;
            case "sub":
                echo "Wynik: " . $a-$b;
                break;
            case "mul":
                echo "Wynik: " . $a*$b;
                    break;
            case "div":
                echo "Wynik: " . $a/$b;
                break;
         }
        }
    }
    ?>
</body>
</html>