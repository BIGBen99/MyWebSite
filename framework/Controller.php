<?php
namespace BIGBen\MyWebSite\Framework;

require_once('Request.php');
require_once('View.php');

abstract class Controller {
    private $action;
    protected $request;
  
    public function setRequest(Request $request) {
        $this->request = $request;
    }
  
    public function executeAction($action) {
        if(method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        } else {
            $controllerClass = get_class($this);
            throw new \Exception('Action ' . $action . 'non définie dans le classe ' . $controllerClass);
        }
    }
  
    public abstract function index();
  
    protected function generateView($viewData = array()) {
        $controllerClass = get_class($this);
        $controller = strtolower(str_replace('Controller', '', str_replace('BIGBen\MyWebSite\Controller\\', '', $controllerClass)));
        $view = new \BIGBen\MyWebSite\Framework\View($this->action, $controller);
        $view->generate($viewData);
    }
}
