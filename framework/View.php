<?php
namespace BIGBen\MyWebSite\Framework;

class View {
    private $file;
    private $title;

    public function __construct($action, $controller = '') {
        $file = 'view/';
        if($controller != '') {
            $file = $file . $controller . '/';
        }
        $this->file = $file . $action . ".php";
    }

    public function generate($data) {
        $content = $this->generateFile($this->file, $data);
        
        $webRoot = Configuration::get('webRoot', "/");
        
        $view = $this->generateFile('view/template.php', array('title' => $this->title, 'content' => $content, 'webRoot' => $webRoot));

        echo $view;
    }

    private function generateFile($file, $data) {
        if(file_exists($file)) {
            extract($data);

            ob_start();
            require($file);
            return ob_get_clean();
        } else {
            throw new \Exception('Fichier ' . $file . ' introuvable');
        }
    }
    
    private function clean($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
