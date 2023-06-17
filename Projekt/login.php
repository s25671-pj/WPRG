<?php  
include "head.php"; 
?>
<body>
    <div class="container">
        <?php
        include "design.php";
        ?>

        <div class="c3 logs">
            <form method="post">
                <h2>Logowanie</h2>
                <label class="label">Nazwa użytkownika: </label><input type="text" name="username" class="input" required><br>
                <label class="label">Hasło: </label><input type="password" name="password" class="input" required><br>
                <button type="submit" class="button">Zaloguj!</button>
            </form>
        </div>
        <div class="c4 logs">
            <button type="button" class="button" onclick="changeLocation()">Przejdź do rejestracji</button>

            <script>
                function changeLocation() {
                    window.location.href = 'register.php';
                }
            </script>
        </div>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($_POST['login'])) {
                $loginMessage = loginUser($username, $password);
                echo $loginMessage;
            }
        }
    }

    function loginUser($username, $password)
    {
        // Połączenie z bazą danych MySQL
        $dbHost = 'localhost:3306';
        $dbUser = 'root';
        $dbPass = 'Ludvinci42!';
        $dbName = 'wprg';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        // Sprawdzenie połączenia z bazą danych
        if ($conn->connect_error) {
            die("Błąd połączenia z bazą danych: " . $conn->connect_error);
        }

        // Sprawdzenie, czy użytkownik o podanej nazwie istnieje
        $query = "SELECT userpassword FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Użytkownik o podanej nazwie nie istnieje
            return "Brak konta o podanej nazwie.";
        } else {
            $row = $result->fetch_assoc();  //pobieranie kolejnego wiersza z wyniku zapytania SQL w formie tablicy asocjacyjnej
            $hashedPassword = $row['userpassword'];

            // Sprawdzenie poprawności hasła
            if (password_verify($password, $hashedPassword)) {
                // Poprawne logowanie
                $loginMessage =  "Zalogowano pomyślnie!";
            } else {
                // Nieprawidłowe hasło
                $loginMessage =  "Nieprawidłowe hasło.";
            }
        }

        // Zwolnienie zasobów i zamknięcie połączenia z bazą danych
        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>