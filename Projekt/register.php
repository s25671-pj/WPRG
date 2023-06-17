<?php  
include "head.php"; 
?>
<body>
    <div class="container">
        <?php
        include "design.php";
        ?>

        <div class="logs c3">
            <form method="post">
                <h2>Rejestracja</h2>
                <label class="label">Nazwa użytkownika: </label><input type="text" name="username" class="input" required><br>
                <label class="label">Hasło: </label><input type="password" name="password" class="input" required><br>
                <button type="submit" class="button">Zarejestruj!</button>
                </from>
        </div>
        <div class="logs c4">
            <button type="button" class="button" onclick="changeLocation()">Przejdź do logowania</button>

            <script>
                function changeLocation() {
                    window.location.href = 'login.php';
                }
            </script>
        </div>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            // Sprawdzanie, które formularze zostały wysłane

            if (isset($_POST['register'])) {
                $registrationSuccess = registerUser($username, $password);

                if ($registrationSuccess) {
                    echo '<script>alert("Rejestracja zakończona sukcesem! Proszę się zalogować."); window.location = "login.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Użytkownik o podanej nazwie już istnieje.");</script>';
                }
            }
        }
    }

    function registerUser($username, $password)
    {
        // Połączenie z bazą danych MySQL
        $dbHost = 'localhost:3306';
        $dbUser = 'root';
        $dbPass = 'Ludvinci42!';
        $dbName = 'wprg';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName); // Utworzenie połączenia z bazą danych

        // Sprawdzenie połączenia z bazą danych
        if ($conn->connect_error) {
            die("Błąd połączenia z bazą danych: " . $conn->connect_error);
        }

        // Sprawdzenie, czy użytkownik o podanej nazwie istnieje
        $query = "SELECT * FROM users WHERE username = ?"; // Zapytanie sprawdzające, czy użytkownik o podanej nazwie istnieje
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Użytkownik o podanej nazwie już istnieje
            return false;
        } else {
            // Użytkownik nie istnieje, można utworzyć nowe konto
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Zaszyfrowanie hasła użytkownika

            // Dodanie nowego użytkownika do bazy danych
            $insertQuery = "INSERT INTO users (username, userpassword) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("ss", $username, $hashedPassword);
            $insertStmt->execute();

            // Zwolnienie zasobów i zamknięcie połączenia z bazą danych
            $insertStmt->close();
            $stmt->close();
            $conn->close();

            return true;
        }
    }
    ?>
</body>

</html>