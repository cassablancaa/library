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
            <form action="szukajksiazkidousun.php" method="post">
                <h3>Szukaj książki do usunięcia</h3>
                Tytuł:<input type="text" name="name">
                <p><input type = "submit" value="Szukaj"></p>

            </form>   
            <form action = "usunksiazke.php" method = "post">
      <p><b>Wprowadz ID książki do usunięcia</b><br>
      <input type="number" name="idk"></p>
      <p><input type = "submit" value="Usuń"></p>
            </form> 
                 <?php
              $conn = mysqli_connect('localhost','root','','library');
              if (!$conn) {
                   die("Connection failed");
              }else{
                  $sql = "SELECT * FROM `BOOK`;";
                  $result = mysqli_query($conn,$sql);
              
                  if(mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_array($result)){ 
                          echo"ID: ".$row[0]."<br>"."Tytuł: ".$row[1]."<br>"."Autor: ".$row[2]."<br>"."ISBN: ".$row[3]."<br>"."Rok wydania: ".$row[4]."<br>"."Opis: ".$row[5]."<br>"."Gatunek: ".$row[6]."<br>"."<br>";
                      }
                          }else{
                          echo"0 results";
                      }

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