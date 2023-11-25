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

            <?php
                $conn = mysqli_connect('localhost','root','','library');
                if (!$conn) {
                    die("Connection failed");
                }else{
                    $id=$_POST['id_u'];
                    $username=$_POST['naz'];
                    $imie=$_POST['imi'];
                    $rola=$_POST['role'];
                    $city=$_POST['mias'];
                    $adres=$_POST['adr'];
                    $mail=$_POST['ema'];
                    $pass=$_POST['has'];
                
                    $update="UPDATE users set nazwisko='$username',imie='$imie',rola='$rola',miasto='$city',adres='$adres',email='$mail',haslo='$pass' WHERE id_user=$id; ";
                    $wynik = mysqli_query($conn,$update);
                      }
                    if(!$wynik)
                    echo "Dane nie zostały zaaktualizowane";
                
                else echo "Dane został zaktualizowane";
                    
                
            ?>

 <nav >
        <br>
            <button onclick="window.location.href='admin.php'">Powrót do panelu administratora</button>
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