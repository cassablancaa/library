<?php
session_start();
if($_SESSION['rola'] !== 'Bibliotekarz') {
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
            <h4><center>Zalogowany jako BIBLIOTEKARZ.</center></h4>
            <p><b>Wprowadz ID użytkownika i książki do odbioru</b><br>
<form action="pick.php" method="post">
                    <form action="pick.php" method="post">
                        ID Użytkownika: <input type="number" name="rentid" required><br>
                        ID Książki: <input type="number" name="rentkid" required><br><br>
                        <input type="submit" value="Odbierz">
                    </form>
                    <br><BR>
                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
                    $sql = "SELECT 
                    W.id_wypozyczenie, 
                    W.id_user, 
                    U.nazwisko, 
                    U.imie, 
                    W.data_wypozyczenie, 
                    W.data_do_kiedy, 
                    W.data_oddania, 
                    W.status, 
                    W.id_egzemplarz, 
                    E.id_ksiazka, 
                    B.tytul, 
                    B.autor, 
                    B.ISBN 
                FROM 
                    WYPOZYCZENIE W 
                INNER JOIN 
                    USERS U ON W.id_user = U.id_user 
                INNER JOIN 
                    EGZEMPLARZ E ON W.id_egzemplarz = E.id_egzemplarz 
                INNER JOIN 
                    BOOK B ON E.id_ksiazka = B.id_ksiazka
                WHERE 
                    W.status = 1;
                ";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_array($result)){ 
                            echo"ID Wypożyczenia: ".$row[0]."<br>"."ID użytkownika: ".$row[1]."<br>"."Nazwisko: ".$row[2]."<br>"."Imię: ".$row[3]."<br>"."Data wypożyczenia: ".$row[4]."<br>"."Data do kiedy: ".$row[5]."<br>"."Data oddania: ".$row[6]."<br>"."Status: ".$row[7]."<br>"."Id Egzemplarza: "
                            .$row[8]."<br>"."Id książki: ".$row[9]."<br>"."Tytuł: ".$row[10]."<br>"."Autor: ".$row[11]."<br>"."ISBN: ".$row[12]."<br>"."<br><BR>";
                        }
                            }else{
                            echo"0 results";
                            }
                    
        }
?>
    <nav >
        <br>
            <button onclick="window.location.href='bibliotekarz.php'">Powrót do panelu bibliotekarza.</button>
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
<?php
mysqli_close($conn);
?>

