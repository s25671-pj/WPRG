<!DOCTYPE html>
<html>
<head>
    <title>Formularz zapisujący dane do pliku</title>
</head>
<body>
    <h1>Wyraź swą opinię</h1>

    <?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nick = $_POST["nick"];
        $opinia = $_POST["opinia"];

        $dane = $nick . " " . $opinia;

        $plik = "dane.txt";

        file_put_contents($plik, $dane . PHP_EOL, FILE_APPEND);

        echo "<p>$nick , twoja opinia została zapisana. Dziękuję!</p>";
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nick">Nick:</label>
        <input type="text" name="nick" id="nick" required><br>

        <label for="opinia">Opinia:</label>
        <textarea name="opinia" id="opinia" rows="4" cols="50"></textarea>

        <input type="submit" value="Prześlij">
    </form>
</body>
</html>