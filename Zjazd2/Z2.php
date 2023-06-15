<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .block {
            width: 30%;
            max-height: 200px;
            overflow: hidden;
            overflow-y: auto;
            text-align: justify;
        }

        .form {
            display: flex;
            flex-direction: column;
            width: 200px;
        }

        .form label {
            text-align: left;
            margin-left: 20px;
        }

        .summary {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: justify;
        }

        .summary h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .summary p {
            margin-bottom: 5px;
        }

        .summary ul {
            list-style-type: none;
            padding: 0;
        }

        .summary li {
            margin-bottom: 5px;
        }
    </style>
    <title>Rezerwacja</title>
</head>

<body>
    <form method="post">
        <h2><i>Formularz rezerwacji hotelowej</i></h2>
        <div class="block">
            <p>Aby zarezerwować pobyt wypełnij poniższy formularz.
                Wybierz liczbę osób, których ma dotyczyć rezerwacja
                oraz podaj swoje dane osobowe i termin pobyt.
                Dodatkowo możesz wybrać ekstra udogodnienia przedstawione poniżej.</p>
        </div><br>
        <div class="form">
            <p>Liczba osób: </p>
            <select id="ppl" name="ppl">
                <option value="Jedna">1</option>
                <option value="Dwie">2</option>
                <option value="Trzy">3</option>
                <option value="Cztery">4</option>
            </select><br>
            <label>Imię </label><input type="text" name="imie" required><br>
            <label>Nazwisko </label><input type="text" name="nazwisko" required><br>
            <label>Adres </label><input type="text" name="adres" required><br>
            <label>Nr Karty Płatniczej</label><input type="number" name="karta" required><br>
            <label>E-mail</label><input type="email" name="email" required><br>
            <label>Pobyt od</label><input type="date" name="pbOD" required><br>
            <label>Pobyt do</label><input type="date" name="pdDO" required><br>
            <label>Godzina przyjazdu</label><input type="time" name="gdz" required><br>
            <label>Czy potrzebujesz dostawienia łóżka dla dziecka?</label><br></div>
            <input type="radio" name="bed" value="Tak">Tak<br>
            <input type="radio" name="bed" value="Nie" checked>Nie<br>
            <div class="form">
            <p>Dodatkowe udogodnienia</p>
            <select id="extra" name="extra[]" multiple style="overflow: hidden;">
                <option value="ex1">Klimatyzacja</option>
                <option value="ex2">Popielniczka</option>
                <option value="ex3">Lodówka</option>
                <option value="ex4">TV z VOD</option>
            </select><br>
            <button type="submit">Potwierdź</button>
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
       
        $liczbaOsob = $_POST["ppl"];
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        $adres = $_POST["adres"];
        $nrKarty = $_POST["karta"];
        $email = $_POST["email"];
        $pobytOd = $_POST["pbOD"];
        $pobytDo = $_POST["pdDO"];
        $godzinaPrzyjazdu = $_POST["gdz"];
        $potrzebaLozkaDziecka = $_POST["bed"];
        $dodatkoweUdogodnienia = isset($_POST["extra"]) ? $_POST["extra"] : array();

        $klimatyzacja = in_array("ex1", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $popielniczka = in_array("ex2", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $lodowka = in_array("ex3", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $tv = in_array("ex4", $dodatkoweUdogodnienia) ? "Tak" : "Nie";

        $summary = "
        <div class='summary'>
            <h2>Podsumowanie rezerwacji</h2>
            <p><strong>Liczba osób:</strong> $liczbaOsob</p>
            <p><strong>Imię:</strong> $imie</p>
            <p><strong>Nazwisko:</strong> $nazwisko</p>
            <p><strong>Adres:</strong> $adres</p>
            <p><strong>Nr Karty Płatniczej:</strong> $nrKarty</p>
            <p><strong>E-mail:</strong> $email</p>
            <p><strong>Pobyt od:</strong> $pobytOd</p>
            <p><strong>Pobyt do:</strong> $pobytDo</p>
            <p><strong>Godzina przyjazdu:</strong> $godzinaPrzyjazdu</p>
            <p><strong>Czy potrzebujesz dostawienia łóżka dla dziecka?</strong> $potrzebaLozkaDziecka</p>
            <p><strong>Dodatkowe udogodnienia:</strong></p>
            <ul>
                <li>Klimatyzacja: $klimatyzacja</li>
                <li>Popielniczka: $popielniczka</li>
                <li>Lodówka: $lodowka</li>
                <li>TV z VOD: $tv</li>
            </ul>
        </div>";

        echo $summary;
    }
    ?>

</body>

</html>
