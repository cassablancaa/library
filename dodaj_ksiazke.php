<?php
session_start();

if($_SESSION['rola'] !== 'Admin' && $_SESSION['rola'] !== 'Bibliotekarz') {
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka Literatury i Technologi </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Biblioteka YSL</h1>
        </header>

        <div class="main-content">
            <div class="books">   
     <div class="form-container">
                    <h2>Dodaj książke</h2>
                    <form action="addbook.php" method="post">
    <input type="text" name="tytul" placeholder="Tytuł" required>
    <input type="text" name="autor" placeholder="Autor" required>
    <input type="text" name="isbn" placeholder="ISBN" required>
    <input type="text" name="rok_wydania" placeholder="Rok wydania" required>
    <input type="text" name="opis" placeholder="Opis" required>                     
    <input type="text" name="gatunek" placeholder="Gatunek" required>
    <button type="submit">Dodaj</button>
    </form>

                </div>
                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{

                }
                if ($_SESSION['rola'] === 'Admin') {
                    echo '<button onclick="window.location.href=\'admin.php\'">Powrót do panelu administratora</button>';}
                    elseif ($_SESSION['rola'] === 'Bibliotekarz') {
                        echo '<button onclick="window.location.href=\'bibliotekarz.php\'">Powrót do panelu bibliotekarza.</button>';
                    }
?>
    <nav >
        <br>
            
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