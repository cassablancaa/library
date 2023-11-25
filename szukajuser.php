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
                $conn=mysqli_connect("localhost","root","","library");
                 if(!$conn){
                    die("Connection failed");
                }else{
                    $user=$_POST['name'];
                    $usern=$_POST['username'];
                    $sql = "SELECT * FROM `users` WHERE imie LIKE '%$user%' AND nazwisko LIKE '%$usern%';";
                    $result = mysqli_query($conn,$sql);
                
                    if(mysqli_num_rows($result)>0){
                        echo'<form action="modify.php" method="post">

                        <p><b>Wprowadz ID użytkownika do modyfikacji</b><br>
                        <input type="number" name="idm"></p>
                    
                        <p><input type="submit" value="Modyfikuj"></p>
                    
                    </form>';
                        while($row=mysqli_fetch_array($result)){ 
                            echo"ID: ".$row[0]."<br>"."Nazwisko: ".$row[1]."<br>"."Imię: ".$row[2]."<br>"."Rola: ".$row[3]."<br>"."Miejscowość: ".$row[4]."<br>"."Adres: ".$row[5]."<br>"."E-mail: ".$row[6]."<br>"."<br>";
                        }
                            }else{
                            echo"0 results";
                            }
              
    echo"<br><br><BR>";

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