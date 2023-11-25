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
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
                $idu = $_POST['rentid'];
                $idk = $_POST['rentkid'];

                $update = "UPDATE WYPOZYCZENIE W
                INNER JOIN EGZEMPLARZ E ON W.id_egzemplarz = E.id_egzemplarz
                SET 
                    W.status = 0,
                    W.data_oddania = NOW(),
                    E.Status = 0,
                    W.przedluzono = 0
                WHERE 
                    W.id_user = '$idu' 
                    AND E.id_ksiazka = '$idk' 
                    AND W.status = 1;";
     
    
                mysqli_query($conn, $update);       
                if (mysqli_affected_rows($conn) > 0) {
                    echo "Operacja wykonana pomyślnie.";
                } else {
                    echo "Operacja nie została wykonana.";
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

