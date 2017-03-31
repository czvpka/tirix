<div>
    <center><ul>
<?php
    ini_set("display_errors", "1");
    require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
    
    $id = $_GET['id'];        
    $query = "SELECT * from items where id = '$id'";
    $result = $dbc->query($query);

    if (!isset($id)) {
        Header("Location: index.php");
    } else {
        if(mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            echo $row['name']."<br>";
            echo "<p>".$row['desc']."</p><br>";
            echo "<a href=''>Kup teraz (".getPrice($row['number']).")</a>";
        } else {
            echo "Taki przedmiot nie istnieje";
        }
    }
?>
    </ul></center>
</div>