<?php
	if(isset($_POST['date1']) && (isset($_POST['date2']))){
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $from = $_POST['date1'];//06/20/2018 6:13 AM
        $from = strtotime("$from");
        $from = date("m/d/Y H:i:s", $from);
        $to = $_POST['date2'];//06/20/2018 6:13 AM
        $to = strtotime("$to");
        $to = date("m/d/Y H:i:s", $to);
        $sche = new \Application\models\Schedule();
        $stmt = $sche->get_schedules_selects($from,$to);
        $stmt->execute([$from,$to]);
        foreach ($stmt as $row)
        {
            $region_id = $row['region_id'];
            $curier_id = $row['curier_id'];
            $date_depart = $row['date_depart'];
            $date_arrival = $row['date_arrival'];
            $reg = new \Application\models\Region();
            $stmt = $reg->get_prepare_by_id($region_id);
            $stmt->execute([$region_id]);
            foreach ($stmt as $row)
            {
                $region_name_final = $row['name'];
                $cur = new \Application\models\Curier();
                $stmt = $cur->get_prepare_by_id($curier_id);
                $stmt->execute([$curier_id]);
                foreach ($stmt as $row)
                {
                    $curier_name_final = $row['name'];
                    echo '<ul><li><br>';
                    echo 'Region: '.$region_name_final.'<br>';
                    echo 'Curier: '.$curier_name_final.'<br>';
                    echo 'Date depart: '.$date_depart.'<br>';
                    echo 'Arrival: '.$date_arrival.'<br>';
                    echo '</li></ul>';
                }
            }
        }
    }
?>