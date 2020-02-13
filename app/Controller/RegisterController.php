<?php


namespace Controller;


class RegisterController extends DisplayController
{
    public function register () {
            $this->mainbar = $this->mainBar();
        parent::display();
    }

    public function mainBar () {
        $data = $this->view->render('register.php',
            [
                'title' => $this->lang['title'],
                'lang' =>  $this->lang,
                'lang_prefix' => $this->lang_prefix
            ]);
        return $data;
    }
}