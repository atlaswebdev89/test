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
        parent::display();
    }

    public function mainBar () {
        return  $this->view->render('404.php',
            [
                'lang' =>  $this->lang,
                'notFound' => $this->lang['notFound']
            ]);
    }
}