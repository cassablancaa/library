<?php
session_start();
if($_SESSION['rola'] !== 'Bibliotekarz') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka Biblioteka Literatury i Technologi </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Biblioteka YSL</h1>
        </header>

        <div class="main-content">
            <div class="books">   
            <h4><center>Zalogowany jako BIBLIOTEKARZ.</center></h4>
            <?php

$conn = mysqli_connect("localhost", "root", "", "library");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['rentid']) && isset($_POST['rentkid']) && isset($_POST['dataodd'])) {
    $idu =  $_POST['rentid'];
    $idk =  $_POST['rentkid'];
    $dataoddania = $_POST['dataodd'];

    $sprawdzUsera = "SELECT * FROM USERS WHERE id_user = '$idu'";
    $result = mysqli_query($conn, $sprawdzUsera);

    if (mysqli_num_rows($result) == 1) {
        $sprawdzstatus = "SELECT * FROM EGZEMPLARZ WHERE id_ksiazka = '$idk' AND Status = 0 LIMIT 1";
        $sprawdzstatus = mysqli_query($conn, $sprawdzstatus);

        if (mysqli_num_rows($sprawdzstatus) == 1) {
            $row = mysqli_fetch_assoc($sprawdzstatus);
            $ide = $row['id_egzemplarz'];

            $rentbook = "INSERT INTO WYPOZYCZENIE (id_user, id_egzemplarz, data_wypozyczenie, data_do_kiedy, status) 
                         VALUES ('$idu', '$ide', NOW(), '$dataoddania', 1)";
            if (mysqli_query($conn, $rentbook)) {
                echo "Pomyślnie wypożyczono książkę.";
                
                $zmienStatusEgzemplarza = "UPDATE EGZEMPLARZ SET Status = 1 WHERE id_egzemplarz = '$ide'";
                if (mysqli_query($conn, $zmienStatusEgzemplarza)) {
                    echo "Status egzemplarza został zmieniony na wypożyczony.";
                } else {
                    echo "Błąd podczas zmiany statusu egzemplarza: " . mysqli_error($conn);
                }
            } else {
                echo "Błąd podczas wypożyczania książki: " . mysqli_error($conn);
            }
        } else {
            echo "Brak dostępnych egzemplarzy tej książki.";
        }
    } else {
        echo "Nieprawidłowy użytkownik. Spróbuj ponownie.";
    }
}

?>

   
    <nav >
        <br>
            <button onclick="window.location.href='bibliotekarz.php'">Powrót do panelu bibliotekarza.</button>
        </nav>
            </div>

            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &copy; 2023 Biblioteka YSL. Wszelkie prawa zastrzeżone. Designed by JO.
        </div>
    </footer>
</body>
<?php
mysqli_close($conn);
?>

