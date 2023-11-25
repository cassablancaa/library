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
                    $id=$_POST['idm'];
                    $sprawdz="SELECT id_user FROM `users` WHERE `id_user` = '$id';";
                    $sprawdz=mysqli_query($conn, $sprawdz);
                    
                    if (mysqli_num_rows($sprawdz) == 0) {
                        header("Location: brak.php");
                        exit();
                    }else{
                        $zapytanie="SELECT * FROM users WHERE id_user='$id';";
                        $wynik=mysqli_query($conn,$zapytanie);

                        $wiersz=mysqli_fetch_array($wynik);

                        $idu=$wiersz['id_user'];
                        $username=$wiersz['nazwisko'];
                        $imie=$wiersz['imie'];
                        $rol=$wiersz['rola'];
                        $city=$wiersz['miasto'];
                        $adress=$wiersz['adres'];
                        $mail=$wiersz['email'];
                        $pass=$wiersz['haslo'];
                
                }
                }
                
            ?>
 <form name="formularz" action="update1.php" method="post">
<h4>Modyfikuj użytkownika

</h4>ID <input type="text" name="id_u" readonly="readonly" value="<?php echo $idu;?>"></br>
Nazwisko  <input type="text" name="naz" required pattern="[A-Za-z]+" title="Proszę wprowadzić tylko litery (bez cyfr)" value="<?php echo $username;?>"><br>
Imię  <input type="text" name="imi" required pattern="[A-Za-z]+" title="Proszę wprowadzić tylko litery (bez cyfr)" value="<?php echo $imie;?>"><br>
Miasto <input type="text" name="mias" value="<?php echo $city;?>"required><br>
Adres <input type="text" name="adr" value="<?php echo $adress;?>"required><br>
E-mail <input type="text" name="ema" value="<?php echo $mail;?>"required><br>
Hasło <input type="text" name="has" value="<?php echo $pass;?>"required><br>
<label for="role">Wybierz rolę:</label>
    <select name="role" id="rol" required>
        <option value="Admin">Admin</option>
        <option value="User_zal">User</option>
        <option value="Bibliotekarz">Bibliotekarz</option>
    </select>
<br><br>
<input type="submit" value="Modyfikuj" name="wyslij">
<input type="reset" value="Wyczyść" name="zeruj">
</form>            

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