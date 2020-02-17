<?php

namespace Controller;

class ErrorController extends DisplayController
{
    public function __construct($container) {
        parent::__construct($container);
    }
    public function NotFound () {
            header("HTTP/1.1 404 Not Found");
            $this->mainbar = $this->mainBar();
    }

    public function mainBar () {
        echo  $this->view->render('404.php',
            [
                'lang' =>  $this->lang                
            ]);
    }
}