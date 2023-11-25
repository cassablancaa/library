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
                <h3>Spis książek</h3>
                <?php
                    $adresURL="librarybooks.php";
                    $conn = mysqli_connect('localhost','root','','library');
                    if (!$conn) {
                         die("Connection failed");
                    }else{
                        $sql = "SELECT * FROM `BOOK` LIMIT 4;";
                        $result = mysqli_query($conn,$sql);
                    
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_array($result)){
                                echo"ID: ".$row[0]."<br>"."Tytuł: ".$row[1]."<br>"."Autor: ".$row[2]."<br>"."ISBN: ".$row[3]."<br>"."Rok wydania: ".$row[4]."<br>"."Opis: ".$row[5]."<br>"."Gatunek: ".$row[6]."<br>"."<br>";
                            }
                                }else{
                                echo"0 results";
                            }
                            echo"By zobaczyć wszystkie książki w naszej bibliotece "; echo '<a href="'.$adresURL.'">Kliknij tutaj</a>';
                            ;
                    }
                ?>
            </div>

            <div class="auth-panel">
                <div class="form-container">
                    <h2>Logowanie</h2>
                    <form action="login.php" method="post">
                        <input type="text" name="email" placeholder="E-mail" required>
                        <input type="password" name="password" placeholder="Hasło" required>
                        <button type="submit">Zaloguj</button>
                    </form>
                </div>

                <div class="form-container">
                    <h2>Rejestracja</h2>
                    <form action="register.php" method="post">
                        <input type="text" name="name" placeholder="Imie" required pattern="[A-Za-z]+" title="Proszę wprowadzić tylko litery (bez cyfr)">
                        <input type="text" name="username" placeholder="Nazwisko" required pattern="[A-Za-z]+" title="Proszę wprowadzić tylko litery (bez cyfr)">
                        <input type="text" name="city" placeholder="Miasto" required>
                        <input type="text" name="adres" placeholder="Adres" required>
                        <input type="text" name="email" placeholder="E-mail" required>
                        <input type="password" name="password" placeholder="Hasło" required>
                        <button type="submit">Zarejestruj</button>
                    </form>
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