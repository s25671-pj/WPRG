<?php
session_start();
include "../main/head.php";
?>

<body>
    <div class="container">
        <?php
        include "../main/design_lout.html";
        ?>

        <div class="c3 logs">
            <form method="post">
                <h2>Logowanie</h2>
                <label class="label">Nazwa użytkownika: </label><input type="text" name="username" class="input" required><br>
                <label class="label">Hasło: </label><input type="password" name="password" class="input" required><br>
                <button type="submit" class="button" name="login">Zaloguj!</button>
            </form>
        </div>
        <div class="c4 logs">
            <a href="../register/register.php"><button type="button" class="button">Przejdź do rejestracji</button></a>
        </div>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $loginSuccess = loginUser($username, $password);

            if ($loginSuccess) {
                $_SESSION['username'] = $username; // Ustawienie nazwy użytkownika w sesji
                setcookie('isLoggedIn', 'true', time() + 86400, '/');
                header("Location: login_ok.php");
                exit;
            } else {
                header("Location: login_error.php");
                exit;
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
            die();
        }

        // Sprawdzenie, czy użytkownik o podanej nazwie istnieje
        $query = "SELECT userpassword FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Użytkownik o podanej nazwie nie istnieje
            return false;
        } else {
            $row = $result->fetch_assoc();  // Pobieranie kolejnego wiersza z wyniku zapytania SQL w formie tablicy asocjacyjnej
            $hashedPassword = $row['userpassword'];

            // Sprawdzenie poprawności hasła
            if (password_verify($password, $hashedPassword)) {
                // Poprawne logowanie
                return true;
            } else {
                // Nieprawidłowe hasło
                return false;
            }
        }

        // Zwolnienie zasobów i zamknięcie połączenia z bazą danych
        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>
