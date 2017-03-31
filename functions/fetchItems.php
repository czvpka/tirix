<?php
    ini_set("display_errors", "1");
    require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
    
    function fetchItems($category, $link) {
        $query = "SELECT * FROM items WHERE category = '$category'";
        $result = $link->query($query);
        $item = 0;

        while($row = $result->fetch_array()) {
            if ($item == 4) {
                // echo "</div>";
                // echo "<div class='row'>";
       	        $item = 0;
    	    }
            echo '<a href="item.php?id='.$row['id'].'">';
            echo '<div class="item">';
            echo '<header>';
            echo '<h1 class="title">'.$row['name'].'</h1>';
            echo '<h2 class="sub-title">'.$row['category'].'</h2>';
            echo '<h1 class="cost">';
	    echo getPrice($row['number']);
	    echo '</h1>';
	    echo '</header>';
            echo '<main>';
            echo '<div class="picture" style="background-image: url('.$row['image'].')"></div>';
	    echo '<div class="shape"></div>';
            echo '</main>';
	    echo '</div>';
	    echo '</a>';
	    $item = $item + 1;
        }
    }
?>