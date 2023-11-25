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
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
               $tittle=$_POST['tytul'];
               $author=$_POST['autor'];
               $isb=$_POST['isbn'];
               $rokwydania=$_POST['rok_wydania'];
               $opi=$_POST['opis'];
               $gatun=$_POST['gatunek'];
    
    $sprawdzisbn = "SELECT * FROM book WHERE ISBN='$isb'";
    $sprawdzisbn = mysqli_query($conn, $sprawdzisbn);

    if (mysqli_num_rows($sprawdzisbn) > 0) {
        echo "Podana książka jest już w bazie danych";
    } else {
        $sql = "INSERT INTO book (tytul,autor,ISBN,rok_wydania,opis,gatunek) VALUES('$tittle','$author', '$isb', '$rokwydania', '$opi', '$gatun')";
        mysqli_query($conn, $sql);
        echo "Pomyślnie dodano książke";
        
    }
    echo"<br><br><BR>";

    }
    if ($_SESSION['rola'] === 'Admin') {
        echo '<button onclick="window.location.href=\'admin.php\'">Powrót do panelu administratora</button>';}
        elseif ($_SESSION['rola'] === 'Bibliotekarz') {
            echo '<button onclick="window.location.href=\'bibliotekarz.php\'">Powrót do panelu bibliotekarza.</button>';
        }
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