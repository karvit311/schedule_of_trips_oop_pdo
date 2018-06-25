<?php
	include 'Curier.php';
	include 'database.php';  	
	if((isset($_POST['new_curier'])) ){	
        $new_curier = addslashes( $_POST['new_curier']);
        $cur = new Curier($pdo);
        $stmt = $cur->get_prepare();
        $stmt->execute(array($new_curier));
        foreach ($stmt as $row)
        {
            $c = $row['id'];
            $count = count($c);
        }
        if ( $count > 0) {
            echo '0';
        }else{ 
			$curier = new Curier($pdo);
            $curier->get_insert($new_curier); 
	        echo '1';
	    } 
	}
?>	