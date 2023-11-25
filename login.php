<?php
session_start();
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
                $adresURL="index.php";
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
        $mail=$_POST['email'];
        $haslo=$_POST['password'];
        $zapytanie="SELECT imie,nazwisko,haslo,email,rola FROM users WHERE haslo='$haslo' AND email='$mail';";
        $result = mysqli_query($conn,$zapytanie);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['email'] = $row['email']; // Przechowaj email w sesji
            $_SESSION['rola'] = $row['rola']; // Przechowaj rolę użytkownika w sesji

            if ($_SESSION['rola'] === 'Admin') {
                header("Location: admin.php"); 
                exit();
            } elseif ($_SESSION['rola'] === 'Bibliotekarz') {
                header("Location: bibliotekarz.php");
                exit();
            } elseif ($_SESSION['rola'] === 'User_zal') {
                header("Location: user.php"); 
                exit();
            } else {
                echo "Nieprawidłowa rola użytkownika.";
            }
    }
}
    echo"<br><br><br>";
    echo"Błędne logowanie,by spróbować jeszcze raz "; echo '<a href="'.$adresURL.'">Kliknij tutaj</a>';
?>
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