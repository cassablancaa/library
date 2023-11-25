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
 
                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
                    $search = 'SELECT USERS.nazwisko, USERS.imie, USERS.email, BOOK.tytul, BOOK.autor, WYPOZYCZENIE.data_wypozyczenie, WYPOZYCZENIE.data_do_kiedy
                    FROM WYPOZYCZENIE
                    JOIN USERS ON WYPOZYCZENIE.id_user = USERS.id_user
                    JOIN BOOK ON WYPOZYCZENIE.id_egzemplarz = BOOK.id_ksiazka
                    WHERE WYPOZYCZENIE.data_do_kiedy < CURDATE() AND WYPOZYCZENIE.status = 1;
                    ';
                    $search = mysqli_query($conn,$search);
                    if (mysqli_num_rows($search) == 0) {
                        echo'Nikt nie zalega z oddaniem książki';
                    }elseif(mysqli_num_rows($search)>0){
                        while($row=mysqli_fetch_array($search)){ 
                            echo"Nazwisko: ".$row[0]."<br>"."Imię: ".$row[1]."<br>"."E-mail: ".$row[2]."<br>"."Tytuł: ".$row[3]."<br>"."Autor: ".$row[4]."<br>"."Data wypożyczenia: ".$row[5]."<br>"."Do kiedy miała być oddana: ".$row[6]."<br>"."<br>";
                }
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

