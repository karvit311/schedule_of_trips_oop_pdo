<?php 
    include('application/models/Curier.php');
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
        <link rel="stylesheet" type="text/css" href="/application/css/site_index.css">
    </head>
    <body>
    	<h2 style="margin: 0 auto;
        width: 500px;">По интервалу дат получить поездки</h2>
        <div  id ="select_form">
        	<a id="add_new_schedule_button"  href="/main/addNewSchedule"> Добавить новую поездку!</a>
            <form method="post" >   
                <br>
                <div>Дата выезда из Москвы:</div>
                <span>From:</span><br/>
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
                <span>To:</span><br/>
                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'  style="width: 50%;">
                                    <input type='text' class="form-control"  id="form-control2" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <br/>
                <button type ="button" id="select_post">Выбрать</button>
            </form> 
            <br>
        </div>
        <?php $res = \Application\core\App::$app->get_db();
        var_dump($res); ?>
        <div id="select_result" style=""></div>

    </body>   
    <script>
        $(document).ready(function(){
            $('#datetimepicker1').datetimepicker();
            $('#datetimepicker2').datetimepicker();
        });
    </script>
</html>
