<?php
session_start();
if($_SESSION['rola'] !== 'Admin') {
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
            <h4><center>Zalogowany jako ADMIN.</center></h4>
 
                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
                }
                
?>
    <nav >
        <br>
            <button onclick="window.location.href='modifyuser.php'">Modyfikacja użytkownika</button>
            <button onclick="window.location.href='dodaj_uzytkownika.php'">Dodanie użytkownika</button>
            <button onclick="window.location.href='delete_user.php'">Usunięcie użytkownika</button>
            <button onclick="window.location.href='dodaj_ksiazke.php'">Dodanie książki</button>
            <button onclick="window.location.href='delete_book.php'">Usunięcie książki</button>
            <button onclick="window.location.href='logout.php'">Wyloguj</button>
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

</html>
<?php
mysqli_close($conn);
?>