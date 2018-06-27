<?php 
    // use \Application\models\Curier;
    // include('application/models/Curier.php');
    include('application/models/Region.php');
    include('application/models/Schedule.php');
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
    	<meta charset = "UTF-8" name = "viewport" content = "width=device-width, initial-scale=1"/>
    	<title>Inserting Data into MySQL Database using PHP, AJAX, JQuery</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/aja/x/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
        <script src="/application/js/site.js"></script>
        <link rel="stylesheet" type="text/css" href="/application/css/site_schedule.css">
    </head>
    <body>
    	<h2 style="margin: 0 auto;
        width: 500px;">Добавить новую поездку</h2>
    	<div  id ="post_form">
            <ul id="add_new_curier_or_region"> 
                <li>
                    <form method="post" >   
                        <br>
                        <input type="text" id="new_curier"><br>
                        <button type ="button" id="add_new_curier">Добавить нового курьера</button>
                    </form> 
                </li>
                <li>
                    <form method="post" >   
                        <br>
                        <input type="text" id="new_region"><br>
                        <button type ="button"  id="add_new_region">Добавить новый регион доставки</button>
                    </form> 
                    <br> 
                </li>
            </ul>
    		<form method="post" id="add_new_schedule_form">	
                <br>
                <label>Курьер:</label>
                <?php $curier = new Curier($pdo);
                    $list = $curier->get_curiers();?>
                    <select id="curier" name="curier"><?php
                        foreach($list as $test) {
                            echo '<option name="'.$test["name"].'" id="'.$test["name"].'">'. $test["name"].'</option>';
                        } ?>
                    </select>
                <br>
                <label>Регион:</label>
                <?php $region = new Region($pdo);
                    $list = $region->get_regions();?>
                    <select id="region" name="region"><?php
                        foreach($list as $test) {
                            echo '<option name="'.$test["name"].'" id="'.$test["name"].'">'. $test["name"].'</option>';
                        } ?>
                    </select><br>
                <label>Дата:</label>
                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'  style="width: 50%;">
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#datetimepicker1').datetimepicker();
                    });
                </script>
                <div id="time_in_road"></div>
    			<button type ="button"  id="add_post">Добавить новую поездку</button>
            </form>	
    		<br>
    	</div>
        <h2 style="margin: 0 auto;
        width: 300px;">Все поездки:</h2>
    	<div id ="result"></div>
        <div id ="result_display"></div>
    </body>
</html>