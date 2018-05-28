<?php
namespace App;

use Src\Controllers\Back;
use Src\Controllers\Front;

class Router
{
    private $_route;
    public function __construct()
    {
        $this->_route = new Back();
        $this->_route = new Front();
    }
    public function initRoute()
    {
        try {
            $url = substr($_SERVER['REQUEST_URI'], strlen(BASEPATH));
            $url = explode('/', filter_var($url, FILTER_SANITIZE_URL));

            if (strlen($url[0]) > 0) {
                $controllerName = 'Src\\Controllers\\'. ucfirst(strtolower($url[0]));
                if (in_array($controllerName, get_declared_classes())) {
                    $this->_route = new $controllerName();
                    if (sizeof($url) > 1) {
                        $method = strtolower($url [1]);
                        if (is_callable([$this->_route, $method])) {
                            $params = isset($url[2]) ? $url[2] : null;
                            $this->_route->$method($params);
                        }
                        if (method_exists($this->_route, $method)) {
                            call_user_func_array([$this->_route, $method], [$params]);
                        }
                    }
                } else {
                    Error::getError('la Route suivant l\'url demandée n\a pas été  trouvée');
                }
            } else {
                $this->_route->index();
            }
        } catch (\Exception $e) {
            Error::getError($e->getMessage());
        }
    }
}
