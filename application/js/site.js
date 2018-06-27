$(document).ready(function(){
    displayResultSelect();
    $('#select_post').on('click', function(){
        $date1 = $('.form-control').val();
        $date2 = $('#form-control2').val();

        $.ajax({
            type: "POST",
            url: "/main/selectPost",
            data: {
                date1: $date1,
                date2: $date2
            },
            success: function(response){
                $('#select_result').html(response);
            }
        });   
    });
});
function displayResultSelect(){
    $.ajax({
        url: '/main/selectPost',
        type: 'POST',
        async: false,
        data:{
            res: 1
        },
        success: function(response){
            $('#select_result').html(response);
        }
    });
}

$(document).ready(function(){

    displayResult();
    /*  ADDING POST */  
    $('#add_post').on('click', function(){
        if($('.form-control').val() == ""){
            alert('Please choose date!');
        }else{
            $time1 = 575;
            $time2 = 1110;
            $time3 = 388;
            $time4 = 220;
            $time5 = 310;
            $time6 = 1500;
            $time7 = 275;
            $time8 = 375;
            $time9 = 890;
            $time10 = 1055;
            $city1 = 'Санкт-Петербург';
            $city2 = 'Уфа';
            $city3 = 'Нижний Новгород';
            $city4 = 'Владимир';
            $city5 = 'Кострома';
            $city6 = 'Екатеринбург';
            $city7 = 'Ковров';
            $city8 = 'Воронеж';
            $city9 = 'Самара';
            $city10 = 'Астрахань';
            $date = $('.form-control').val();
            $region = $('#region').val();
            $curier = $('#curier').val();

            if($region == $city1){$time_in_road = $time1;}
            if($region == $city2){$time_in_road = $time2;}
            if($region == $city3){$time_in_road = $time3;}
            if($region == $city4){$time_in_road = $time4;}
            if($region == $city5){$time_in_road = $time5;}
            if($region == $city6){$time_in_road = $time6;}
            if($region == $city7){$time_in_road = $time7;}
            if($region == $city8){$time_in_road = $time8;}
            if($region == $city9){$time_in_road = $time9;}
            if($region == $city10){$time_in_road = $time10;}
            $('#time_in_road').html($time_in_road);           
            $.ajax({
                type: "POST",
                url: "/main/addPost",
                data: {
                    region:$region,
                    curier:$curier,
                    date_depart:$date,
                    time_in_road:$time_in_road
                },
                success: function(result){
                    var res = parseInt(result);
                    if (res == 1) {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }else{
                        alert('Данная поездка уже существует!');
                    }
                }
            });
        }   
    });
    $('#add_new_region').on('click', function(){
        if($('#new_region').val() == ""){
            alert('Please enter new region');
        }else{
            $new_region = $('#new_region').val();
            $action = "Add";
            $.ajax({
                type: "POST",
                url: "/main/addNewRegion",
                data: {
                    new_region: $new_region,
                    action: $action
                },
                success: function(result){
                    var res = parseInt(result);
                    if (res == 1) {
                        alert('Новый регион добавлен!');
                        $('input[type="text"]').val('');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }else{
                        alert('Данный регион уже существует!');
                    }
                }
            });
        }
    });
    $('#new_region').focus(function(){
        $(this).val('');
    });
    $('#new_curier').focus(function(){
        $(this).val('');
    });
    $('#add_new_curier').on('click', function(){
        if($('#new_curier').val() == ""){
            alert('Please enter new curier');
        }else{
            $new_curier = $('#new_curier').val();
            $.ajax({
                type: "POST",
                url: "/main/addNewCurier",
                data: {
                    new_curier: $new_curier
                },
                success: function(result){
                    var res = parseInt(result);
                    if (res == 1) {
                        alert('Новый курьер добавлен!');
                        $('input[type="text"]').val('');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }else{
                        alert('Такой курьер уже существует!');
                    }
                }
            });
        }
    });
});
function displayResult(){
    $.ajax({
        url: '/main/addPost',
        type: 'POST',
        async: false,
        data:{
            res: 1
        },
        success: function(response){
            $('#result_display').html(response);
        }
    });
}
    