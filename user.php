<?php
session_start();

if ($_SESSION['rola'] !== 'User_zal') {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka Biblioteka Literatury i Technologii </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Biblioteka YSL</h1>
        </header>

        <div class="main-content">
            <div class="books">   
                <p><center>Zalogowany jako USER.</center></p>
                
                <?php
                $mail = $_SESSION['email'];
                $conn = mysqli_connect("localhost", "root", "", "library");

                if (!$conn) {
                    die("Connection failed");
                } else {
                    $sql = "SELECT * FROM users WHERE email = '$mail'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $user_row = mysqli_fetch_assoc($result);
                        $user_id = $user_row['id_user'];

                        $sql = "SELECT * FROM WYPOZYCZENIE
                        INNER JOIN EGZEMPLARZ ON WYPOZYCZENIE.id_egzemplarz = EGZEMPLARZ.id_egzemplarz
                        INNER JOIN BOOK ON EGZEMPLARZ.id_ksiazka = BOOK.id_ksiazka
                        WHERE WYPOZYCZENIE.id_user = $user_id
                        AND WYPOZYCZENIE.status = 1";
                
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<h2>Twoje wypożyczone książki:</h2>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p>ID Egzemplarza: " . $row['id_egzemplarz'] . "<br>";
                                echo "Tytuł: " . $row['tytul'] . "<br>";
                                echo "Autor: " . $row['autor'] . "<br>";
                                echo "Data zwrotu: " . $row['data_do_kiedy'] . "<br></p>";

                                echo "<form method='post' action='przedluz.php'>";
                                echo "Przedłuż wypożyczenie egzemplarza o ID:"."<input type='number' name='idegzemplarza' placeholder='ID egzemplarza' required>";
                                echo"<br>";
                                echo"<br>";
                                echo "<button type='submit'>Przedłuż wypożyczenia o 2 tygodnie</button>";
                                echo "</form>";

                                echo "</p>";
                            }
                        } else {
                            echo "<p>Nie masz wypożyczonych książek.</p>";
                        }
                    } else {
                        echo "0 Result";
                    }
                }
                ?>

                <nav>
                    <br>
                    <button onclick="window.location.href='logout.php'">Wyloguj</button>
                </nav>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &copy; 2023 Biblioteka YSL. Wszelkie prawa zastrzeżone. Designed by JO.
        </div>
    </footer>
</body>

</html>

<?php
mysqli_close($conn);
?>
