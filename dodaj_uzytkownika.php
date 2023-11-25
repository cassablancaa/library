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
            <h4><center>Zalogowany jako ADMIN.</center></h4>
     <div class="form-container">
                    <h2>Dodaj użytkownika</h2>
                    <form action="adduser.php" method="post">
    <input type="text" name="name" placeholder="Imie" required pattern="[A-Za-zĄ-ź]+" title="Proszę wprowadzić tylko litery (bez cyfr i innych znaków)">
    <input type="text" name="username" placeholder="Nazwisko" required pattern="[A-Za-zĄ-ź]+" title="Proszę wprowadzić tylko litery (bez cyfr i innych znaków)">
    <input type="text" name="city" placeholder="Miasto" required>
    <input type="text" name="adres" placeholder="Adres" required>
    <input type="text" name="email" placeholder="E-mail" required>                     
    <input type="password" name="password" placeholder="Hasło" required>

    <label for="role">Wybierz rolę:</label>
    <select name="role" id="role" required>
        <option value="Admin">Admin</option>
        <option value="User_zal">User</option>
        <option value="Bibliotekarz">Bibliotekarz</option>
    </select>
<br><br>
    <button type="submit">Dodaj</button>
    </form>

                </div>
                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{

                }
                
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