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
                    $adresURL="admin.php";
                        $conn = mysqli_connect('localhost','root','','library');
                        if (!$conn) {
                             die("Connection failed");
                        }else{
                            $id=$_POST['idu'];
                            $sprawdz="SELECT id_user FROM `users` WHERE `id_user` = '$id';";
                            $sprawdz=mysqli_query($conn, $sprawdz);
                            
                            if (mysqli_num_rows($sprawdz) == 0) {
                                echo "Nie ma użytkownika o ID: "."$id ";
                            }else{
                            $sql = "DELETE FROM `users` WHERE `id_user` = '$id';";
                            mysqli_query($conn, $sql);
                            echo "Pomyślnie usunięto użytkownika o ID: "."$id ";
                        }
                    }

                        ?>
                 <nav >
        <br>
            <button onclick="window.location.href='admin.php'">Powrót do panelu administratora</button>
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