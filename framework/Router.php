<?php
namespace BIGBen\MyWebSite\Framework;

require_once('Request.php');
require_once('View.php');

class Router {
    public function routeRequest() {
        try {
            $request = new \BIGBen\MyWebSite\Framework\Request(array_merge($_GET, $_POST));
            
            $controller = $this->createController($request);
            $action = $this->createAction($request);
            
            $controller->executeAction($action);
        } catch(Exception $e) {
            $this->manageError($e);
        }
    }
    
    private function createController(Request $request) {
        $controller = "Home";
        if($request->parameterExist('controller')) {
            $controller = $request->getParameter('controller');
            $controller = ucfirst(strtolower($controller));
        }
        
        $controllerClass = $controller . 'Controller';
        $controllerFile = 'controller/' . $controllerClass . '.php';
        if(file_exists($controllerFile)) {
            require($controllerFile);
            $controller = new ('\BIGBen\MyWebSite\Controller\\' . $controllerClass)();
            $controller->setRequest($request);
            return $controller;
        } else {
            throw new \Exception('Fichier ' . $controllerFile . ' introuvable');
        }
    }
    
    private function createAction(Request $request) {
        $action = "index";
        if($request->parameterExist('action')) {
            $action = $request->getParameter('action');
        }
        return $action;
    }
    
    private function manageError(Exception $exception) {
        $view = new \BIGBen\MyWebSite\Framework\View('error');
        $view->generate(array('errorMessage' => $exception->getMessage()));
    }
}
