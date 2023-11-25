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
                <form action="fraza.php" method="POST">
                    Wyszukaj: <input type="text" name="search">

<label for="gatune">Gatunek Literacki:</label>
<select name="gatune">
<option value="">Brak gatunku</option>
    <option value="Horror">Horror</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Romance">Romance</option>
    <option value="Science Fiction">Science Fiction</option>
    <option value="Fiction">Fiction</option>
    <option value="Opowieść">Opowieść</option>
</select>

<label for="sortuj">Sortuj:</label>
<select name="sortuj">
    <option value="">Brak sortowania</option>
    <option value="id_ksiazka ASC">Rosnąco</option>
    <option value="id_ksiazka DESC">Malejąco</option>
    <option value="tytul ASC">Alfabetycznie rosnąco</option>
    <option value="tytul DESC">Alfabetycznie malejąco</option>
    <option value="autor ASC">Autor rosnąco</option>
    <option value="autor DESC">Autor malejąco</option>
</select>

                    <br><br>
                    <input type="submit" value="Szukaj">
                </form>
                <br>

                <?php
                    $adresURL="index.php";
                        $conn = mysqli_connect('localhost','root','','library');
                        if (!$conn) {
                             die("Connection failed");
                        }else {
                            $sql = "SELECT B.*, E.id_egzemplarz, W.data_wypozyczenie, W.data_oddania, W.status as status_wypozyczenia 
                            FROM `BOOK` B 
                            INNER JOIN `EGZEMPLARZ` E ON B.id_ksiazka = E.id_ksiazka
                            INNER JOIN `WYPOZYCZENIE` W ON E.id_egzemplarz = W.id_egzemplarz";
                
                                $result = mysqli_query($conn, $sql);
            
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "ID: " . $row['id_ksiazka'] . "<br>"
                                            . "Tytuł: " . $row['tytul'] . "<br>"
                                            . "Autor: " . $row['autor'] . "<br>"
                                            . "ISBN: " . $row['ISBN'] . "<br>"
                                            . "Rok wydania: " . $row['rok_wydania'] . "<br>"
                                            . "Opis: " . $row['opis'] . "<br>"
                                            . "Gatunek: " . $row['gatunek'] . "<br>"
                                            . "ID Egzemplarza: " . $row['id_egzemplarz'] . "<br>";
            
                                        if (!empty($row['data_wypozyczenie'])) {
                                            $dataWypozyczenia = $row['data_wypozyczenie'];
                                            $dataOddania = $row['data_oddania'];
                                            $statusWypozyczenia = $row['status_wypozyczenia'];
            
                                            if ($statusWypozyczenia == 1) {
                                                echo '<span style="color: red;">Nieoddana (wypożyczona od ' . $dataWypozyczenia . ')</span><br><br>';
                                            } else {
                                                echo '<span style="color: green;">Oddana (wypożyczona od ' . $dataWypozyczenia . ', oddana ' . $dataOddania . ')</span><br><br>';
                                            }
                                        } else {
                                            echo '<span style="color: green;">Dostępna</span><br><br>';
                                        }
                                    }
                                } else {
                                    echo "Brak wyników";
                                }
                                echo "By powrócić do strony głównej ";
                                echo '<a href="' . $adresURL . '">Kliknij tutaj</a>';
                            }
                        
                            ?>
                
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