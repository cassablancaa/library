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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            <p><b>Wprowadz ID użytkownika do wypożyczenia książki</b><br>
<form action="rent.php" method="post">
                    <form action="rent_book.php" method="post">
                        ID Użytkownika: <input type="number" name="rentid" required><br>
                        ID Książki: <input type="number" name="rentkid" required><br>
                        Data oddania: <input type="text" name="dataodd" class="datepicker" required><br>
                        <input type="submit" value="Wypożycz">
                    </form>

                    <script>
                        flatpickr('.datepicker', {
                            dateFormat: 'Y-m-d',
                        });
                    </script>

                 <?php
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else {
                          $conn=mysqli_connect("localhost","root","","library");
                           if(!$conn){
                              die("Connection failed");
                          }else{
                            $sql = "SELECT * FROM `users` WHERE rola = 'User_zal';";
                            $result = mysqli_query($conn,$sql);
                              $sql1 = "SELECT B.id_ksiazka, B.tytul, B.autor, B.ISBN, B.rok_wydania, B.opis, B.gatunek, E.id_egzemplarz, E.Status
                              FROM BOOK B
                              INNER JOIN EGZEMPLARZ E ON B.id_ksiazka = E.id_ksiazka WHERE status='0';";
                              $result1 = mysqli_query($conn,$sql1);
                          
                              if(mysqli_num_rows($result1)>0){
                                  while($row1=mysqli_fetch_array($result1)){ 
                                      echo"ID książki: ".$row1[0]."<br>"."Tytuł: ".$row1[1]."<br>"."Autor: ".$row1[2]."<br>"."ISBN: ".$row1[3]."<br>"."Rok wydania: ".$row1[4]."<br>"."Opis: ".$row1[5]."<br>"."Gatunek: ".$row1[6]."<br>"."Id Egzemplarza: ".$row1[7]."<br>"."Status: ".$row1[8]."<br>"."<br>";
                                  }
                                      }else{
                                        echo"<br>";
                                      echo"Wszystkie książki są wypożyczone";
                                  }
                                  echo"<br><br>";
                                  for ($i=0; $i <=216 ; $i++) { 
                                    echo"-";
                                  }
                                  echo"<br>";
                          }
                              if(mysqli_num_rows($result)>0){
                                  while($row=mysqli_fetch_array($result)){ 
                                      echo"ID: ".$row[0]."<br>"."Nazwisko: ".$row[1]."<br>"."Imię: ".$row[2]."<br>"."Rola: ".$row[3]."<br>"."Miejscowość: ".$row[4]."<br>"."Adres: ".$row[5]."<br>"."E-mail: ".$row[6]."<br>"."<br>";
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

