<?php
namespace Application\core;
class Controller {
        protected $view;
 
                function __construct(){
                        // используем наш View, описанный ранее
                        $this->view = new View();

                }
 
    // другие полезные методы вроде redirect($url);
}
