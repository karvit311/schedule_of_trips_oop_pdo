<?php
namespace Application\core;
/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router
{
    /**
    * Свойство для хранения массива роутов
    * @var array 
    */
    private $routes;
    /**
    * Конструктор
    */
    public function __construct()
    {
        // Путь к файлу с роутами
        $routesPath = ROOT . '/application/routes.php';

        // Получаем роуты из файла
        $this->routes = include($routesPath);
    }
    /**
    * Возвращает строку запроса
    */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    /**
    * Метод для обработки запроса
    */
    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();
        // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
        foreach ($this->routes as $uriPattern => $path) {
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {
                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/application/controllers/' .
                $controllerName . '.php';
                // Создать объект, вызвать метод (т.е. action)
                $controller_paths= "\\Application\\controllers\\".$controllerName;
                $controllerObject = new $controller_paths;
                /* Вызываем необходимый метод ($actionName) у определенного
                * класса ($controllerObject) с заданными ($parameters) параметрами
                */
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                // Если метод контроллера успешно вызван, завершаем работу роутера
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
