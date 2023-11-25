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
           
                <br>

                <?php
$adresURL = "index.php";
$adres = "librarybooks.php";

$conn = mysqli_connect('localhost', 'root', '', 'library');
if (!$conn) {
    die("Connection failed");
} else {
    $fraza = $_POST['search'];
    $gatunek = $_POST['gatune'];
    $sortowanie = $_POST['sortuj'];

    $sql = "SELECT B.*, E.id_egzemplarz, W.data_wypozyczenie, W.data_oddania, W.status as status_wypozyczenia 
            FROM `BOOK` B 
            INNER JOIN `EGZEMPLARZ` E ON B.id_ksiazka = E.id_ksiazka
            INNER JOIN `WYPOZYCZENIE` W ON E.id_egzemplarz = W.id_egzemplarz
            WHERE B.tytul LIKE '%$fraza%' 
            OR B.Opis LIKE '%$fraza%' 
            OR B.autor LIKE '%$fraza%'
            OR B.gatunek LIKE '%$gatunek%'";

    if (!empty($sortowanie)) {
        $sql .= " ORDER BY $sortowanie";
    }

    echo "<br>";
    echo "By powrócić do wyszukiwarki ";
    echo '<a href="' . $adres . '">Kliknij tutaj</a>';
    echo "<br><br>";

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
        echo "<br><br>";
    }
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