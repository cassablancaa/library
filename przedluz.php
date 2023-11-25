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
                    $user = "SELECT * FROM users WHERE email = '$mail'";
                    $wynik = mysqli_query($conn, $user);

                    if ($wynik) {
                        $user_row = mysqli_fetch_assoc($wynik);
                        $user_id = $user_row['id_user'];

                        $idk = $_POST['idegzemplarza'];

                        // Sprawdź, czy ten egzemplarz już został przedłużony
                        $weryfikacja = "SELECT * FROM WYPOZYCZENIE WHERE id_egzemplarz = $idk AND id_user = $user_id AND przedluzono = 0";
                        $wresult = mysqli_query($conn, $weryfikacja);

                        if (mysqli_num_rows($wresult) > 0) {
                            $sql = "UPDATE WYPOZYCZENIE SET data_do_kiedy = data_do_kiedy + INTERVAL 2 WEEK, przedluzono = 1 WHERE id_egzemplarz = $idk AND id_user = $user_id";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                echo "Pomyślnie przedłużono termin oddania.";
                            } else {
                                echo "Nie udało się przedłużyć terminu oddania egzemplarza";     
                            }
                        } else {
                            echo "Nieprawidłowe ID egzemplarza, egzemplarz nie należy do Ciebie lub termin został już przedłużony.";
                        }
                    }
                }
                ?>

                <nav>
                    <br>
                    <button onclick="window.location.href='user.php'">Powrót do panelu użytkownika</button>
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
