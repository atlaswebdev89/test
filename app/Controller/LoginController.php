<?php


namespace Controller;


class LoginController extends DisplayController
{
    public function login () {
            $this->mainbar = $this->mainBarLogin();
        parent::display();
    }

    public function mainBarLogin () {
            $data = $this->view->render('login.php',
                [
                    'title' => $this->lang['title'],
                    'lang' =>  $this->lang,
                    'lang_prefix' => $this->lang_prefix,
                ]);
            return $data;
    }
}