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
            <select id="ppl" name="ppl" onchange="showForms()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br>
        </div>
        <div id="personForms"></div>
        <div class="form">
            <label>Czy potrzebujesz dostawienia łóżka dla dziecka?</label><br>
            <input type="radio" name="bed" value="Tak">Tak<br>
            <input type="radio" name="bed" value="Nie" checked>Nie<br>
            <label>Pobyt od</label><input type="date" name="pbOD" required><br>
            <label>Pobyt do</label><input type="date" name="pdDO" required><br>
            <label>Godzina przyjazdu</label><input type="time" name="gdz" required><br>
            <p>Dodatkowe udogodnienia</p>
            <select id="extra" name="extra[]" multiple style="overflow: hidden;">
                <option value="ex1">Klimatyzacja</option>
                <option value="ex2">Popielniczka</option>
                <option value="ex3">Lodówka</option>
                <option value="ex4">TV z VOD</option>
            </select><br>
            <input type="submit" value="Zarezerwuj">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $liczbaOsob = isset($_POST["ppl"]) ? $_POST["ppl"] : 0;
        $dodatkoweUdogodnienia = isset($_POST["extra"]) ? $_POST["extra"] : array();
        $bedForChild = isset($_POST["bed"]) ? $_POST["bed"] : "Nie";
        $pbOD = isset($_POST["pbOD"]) ? $_POST["pbOD"] : "";
        $pdDO = isset($_POST["pdDO"]) ? $_POST["pdDO"] : "";
        $gdz = isset($_POST["gdz"]) ? $_POST["gdz"] : "";

        $osoby = array();
        for ($i = 1; $i <= $liczbaOsob; $i++) {
            $imie = isset($_POST["imie{$i}"]) ? $_POST["imie{$i}"] : "";
            $nazwisko = isset($_POST["nazwisko{$i}"]) ? $_POST["nazwisko{$i}"] : "";
            $adres = isset($_POST["adres{$i}"]) ? $_POST["adres{$i}"] : "";
            $karta = isset($_POST["karta{$i}"]) ? $_POST["karta{$i}"] : "";
            $email = isset($_POST["email{$i}"]) ? $_POST["email{$i}"] : "";

            $osoba = array(
                "imie" => $imie,
                "nazwisko" => $nazwisko,
                "adres" => $adres,
                "karta" => $karta,
                "email" => $email
            );
            array_push($osoby, $osoba);
        }

        $klimatyzacja = in_array("ex1", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $popielniczka = in_array("ex2", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $lodowka = in_array("ex3", $dodatkoweUdogodnienia) ? "Tak" : "Nie";
        $tv = in_array("ex4", $dodatkoweUdogodnienia) ? "Tak" : "Nie";

        $summary = "
        <div class='summary'>
            <h2>Podsumowanie rezerwacji</h2>
            <p><strong>Liczba osób:</strong> $liczbaOsob</p>
            <h3>Dane osobowe:</h3>
            <ul>";
        $j = 1;
        foreach ($osoby as $osoba) {
            $imie = $osoba["imie"];
            $nazwisko = $osoba["nazwisko"];
            $adres = $osoba["adres"];
            $karta = $osoba["karta"];
            $email = $osoba["email"];

            $summary .= "
            <li><strong>$j. Osoba:</strong></li>
                <li><strong>Imię:</strong> $imie</li>
                <li><strong>Nazwisko:</strong> $nazwisko</li>
                <li><strong>Adres:</strong> $adres</li>
                <li><strong>Numer karty kredytowej:</strong> $karta</li>
                <li><strong>Email:</strong> $email</li><br>
                ";
            $j++;
        }

        $summary .= "
            </ul>
            <h3>Informacje dotyczące pobytu:</h3>
            <ul>
                <li><strong>Data od:</strong> $pbOD</li>
                <li><strong>Data do:</strong> $pdDO</li>
                <li><strong>Godzina przyjazdu:</strong> $gdz</li>
            </ul>
            <h3>Dodatkowe udogodnienia:</h3>
            <ul>
            <li><strong>Łóżko dla dziecka:</strong> $bedForChild</li>
                <li><strong>Klimatyzacja:</strong> $klimatyzacja</li>
                <li><strong>Popielniczka:</strong> $popielniczka</li>
                <li><strong>Lodówka:</strong> $lodowka</li>
                <li><strong>TV z VOD:</strong> $tv</li>
            </ul>
            
        </div>
        ";

        echo $summary;
    }
    ?>

    <script>
        function showForms() {
            var select = document.getElementById("ppl");
            var numPersons = select.options[select.selectedIndex].value;
            var formsDiv = document.getElementById("personForms");
            formsDiv.innerHTML = "";

            for (var i = 1; i <= numPersons; i++) {
                var form = document.createElement("div");
                form.classList.add("form");
                form.innerHTML = `
                <h3>Osoba ${i}</h3>
                <label>Imię:</label>
                <input type="text" name="imie${i}" required><br>
                <label>Nazwisko:</label>
                <input type="text" name="nazwisko${i}" required><br>
                <label>Adres:</label>
                <input type="text" name="adres${i}" required><br>
                <label>Numer karty kredytowej:</label>
                <input type="text" name="karta${i}" required><br>
                <label>Email:</label>
                <input type="email" name="email${i}" required><br>
                `;

                formsDiv.appendChild(form);
            }
        }
    </script>
</body>

</html>