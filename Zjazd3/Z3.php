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
            <input type="submit" name="submit" value="Zarezerwuj">
            <input type="submit" name="load" value="Wczytaj">
        </div>
    </form>

    <?php
    function saveDataToCSV($data)
    {
        $file = fopen("rezerwacje.csv", "a");
        fputcsv($file, $data, ";");
        fclose($file);
    }

    function loadDataFromCSV()
    {
        $file = fopen("rezerwacje.csv", "r");
        $data = array();
        while (($row = fgetcsv($file, 0, ";")) !== false) {
            $data[] = $row;
        }
        fclose($file);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
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

            $data = array(
                $liczbaOsob,
                $bedForChild,
                $pbOD,
                $pdDO,
                $gdz,
                $klimatyzacja,
                $popielniczka,
                $lodowka,
                $tv
            );

            foreach ($osoby as $osoba) {
                $data[] = $osoba["imie"];
                $data[] = $osoba["nazwisko"];
                $data[] = $osoba["adres"];
                $data[] = $osoba["karta"];
                $data[] = $osoba["email"];
            }

            saveDataToCSV($data);
        } elseif (isset($_POST["load"])) {
            $rezerwacje = loadDataFromCSV();
            if (!empty($rezerwacje)) {
                echo "<h2>Wczytane rezerwacje:</h2>";
                foreach ($rezerwacje as $rezerwacja) {
                    echo "<div class='summary'>";
                    echo "<h2>Podsumowanie rezerwacji</h2>";
                    echo "<p><strong>Liczba osób:</strong> {$rezerwacja[0]}</p>";
                    echo "<h3>Dane osobowe:</h3>";
                    echo "<ul>";
                    $k = 0;
                    $numPersons = $rezerwacja[$k];
                    $j = 1;
                    for ($i = 0; $i < $numPersons; $i++) {
                        $index = $i * 5 + 1;
                        $imie = $rezerwacja[$index + 8];
                        $nazwisko = $rezerwacja[$index + 9];
                        $adres = $rezerwacja[$index + 10];
                        $karta = $rezerwacja[$index + 11];
                        $email = $rezerwacja[$index + 12];
                        echo "<li><strong>$j. Osoba:</strong></li>";
                        echo "<li><strong>Imię:</strong> $imie</li>";
                        echo "<li><strong>Nazwisko:</strong> $nazwisko</li>";
                        echo "<li><strong>Adres:</strong> $adres</li>";
                        echo "<li><strong>Numer karty kredytowej:</strong> $karta</li>";
                        echo "<li><strong>Email:</strong> $email</li><br>";
                        $j++;
                        if($i == $numPersons - 1){
                            $k++;
                        }
                    }
                    echo "</ul>";
                    echo "<h3>Informacje dotyczące pobytu:</h3>";
                    echo "<ul>";
                    echo "<li><strong>Data od:</strong> {$rezerwacja[2]}</li>";
                    echo "<li><strong>Data do:</strong> {$rezerwacja[3]}</li>";
                    echo "<li><strong>Godzina przyjazdu:</strong> {$rezerwacja[4]}</li>";
                    echo "</ul>";
                    echo "<h3>Dodatkowe udogodnienia:</h3>";
                    echo "<ul>";
                    echo "<li><strong>Łóżko dla dziecka:</strong> {$rezerwacja[1]}</li>";
                    echo "<li><strong>Klimatyzacja:</strong> {$rezerwacja[5]}</li>";
                    echo "<li><strong>Popielniczka:</strong> {$rezerwacja[6]}</li>";
                    echo "<li><strong>Lodówka:</strong> {$rezerwacja[7]}</li>";
                    echo "<li><strong>TV z VOD:</strong> {$rezerwacja[8]}</li>";
                    echo "</ul>";
                    echo "</div>";
                }
            } else {
                echo "<h2>Brak wczytanych rezerwacji</h2>";
            }
        }
    }
    ?>

    <script>
        function showForms() {
            const ppl = document.getElementById("ppl").value;
            const personForms = document.getElementById("personForms");
            personForms.innerHTML = "";

            for (let i = 1; i <= ppl; i++) {
                const form = document.createElement("div");
                form.className = "form";
                form.innerHTML = `
                    <label>Imię osoby ${i}</label><input type="text" name="imie${i}" required><br>
                    <label>Nazwisko osoby ${i}</label><input type="text" name="nazwisko${i}" required><br>
                    <label>Adres osoby ${i}</label><input type="text" name="adres${i}" required><br>
                    <label>Numer karty kredytowej osoby ${i}</label><input type="text" name="karta${i}" required><br>
                    <label>Email osoby ${i}</label><input type="email" name="email${i}" required><br>
                `;

                personForms.appendChild(form);
            }
        }
    </script>
</body>

</html>
