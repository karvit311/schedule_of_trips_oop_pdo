<?php
	include 'Region.php';
	include 'database.php';  	
	if((isset($_POST['new_region'])) ){	
        $new_region = addslashes( $_POST['new_region']);
        $reg = new Region($pdo);
        $stmt = $reg->get_prepare();
        $stmt->execute(array($new_region));
        foreach ($stmt as $row)
        {
            $c = $row['id'];
            $count = count($c);
        }
        if ( $count > 0) {
            echo 'yes';
        }else{ 
			$region = new Region($pdo);
            $region->get_insert($new_region); 
	        echo '1';
	    } 
	}
?>			
