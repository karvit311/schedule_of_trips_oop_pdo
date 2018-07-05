<?php

namespace Application\controllers;

use Application\models\Curier;
use Application\models\Schedule;
use Application\models\Region;
use Application\core\App;

class MainController
{
    public $view;
    function __construct()
    {
        $this->view = new \Application\core\View();
    }
    public function actionIndex()
    {
        $this->view->generate('index.php', 'layout.php');
    }

    public function actionSelectPost()
    {
        $this->view->generate('select_post.php', 'layout.php');
    }

    public function actionAddNewSchedule()
    {
        $this->view->generate('add_new_schedule.php', 'layout.php');
    }

    public function actionAddNewRegion()
    {
        if ((isset($_POST['new_region']))) {
            $new_region = addslashes($_POST['new_region']);
            $reg = new Region();
            $stmt = $reg->get_prepare($new_region);
            $stmt->execute([$new_region]);
            $count = $stmt->rowCount();
            if ($count > 0) {
                echo 'count<br>';
            } else {
                $curier = new Region();
                $curier->insert($new_region);
                echo '1';
            }
        }
    }

    public function actionAddNewCurier()
    {
        if ((isset($_POST['new_curier']))) {
            $new_curier = addslashes($_POST['new_curier']);
            $cur = new Curier();
            $stmt = $cur->get_prepare($new_curier);
            $stmt->execute([$new_curier]);
            $count = $stmt->rowCount();
            if ($count > 0) {
                echo 'count';
            } else {
                $curier = new Curier();
                $curier->insert($new_curier);
                echo '1';
            }
        }
    }

    public function actionAddPost()
    {
        if ((isset($_POST['region']) && isset($_POST['curier'])) && isset($_POST['date_depart']) && isset($_POST['time_in_road'])) {
            $add_post = new Schedule();
            $add_post->add_post($_POST['region'], $_POST['curier'], $_POST['date_depart'], $_POST['time_in_road']);
        }
        if (isset($_POST['res'])) {
            $get_res = new Schedule();
            $get_res->get_res($_POST['res']);
        }
    }
}
