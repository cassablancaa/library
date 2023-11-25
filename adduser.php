<?php
session_start();
if($_SESSION['rola'] !== 'Admin' ) {
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
                 <?php
                $adresURL="admin.php";
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
               $imie=$_POST['name'];
               $nazwisko=$_POST['username'];
               $miasto=$_POST['city'];
               $adress=$_POST['adres'];
               $mail=$_POST['email'];
               $pass=$_POST['password'];
               $rola=$_POST['role'];
    
    $sprawdzemail = "SELECT * FROM users WHERE email='$mail'";
    $sprawdzemail = mysqli_query($conn, $sprawdzemail);

    if (mysqli_num_rows($sprawdzemail) > 0) {
        echo "Podany adres email już istnieje. Proszę podać inny adres email.";
    } else {
        $sql = "INSERT INTO users(nazwisko, imie, miasto, adres, email, haslo,rola) VALUES('$nazwisko', '$imie', '$miasto', '$adress', '$mail', '$pass','$rola')";
        mysqli_query($conn, $sql);
        echo "Pomyślnie założono konto";
        
    }
    echo"<br><br><BR>";
    echo"Pomyślnie dodano $rola do bazy danych.";

    }
?>
            <button onclick="window.location.href='bibliotekarz.php'">Powrót do panelu bibliotekarza.</button>

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

</html>
<?php
mysqli_close($conn);
?>