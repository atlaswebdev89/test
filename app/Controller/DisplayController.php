<?php

namespace Controller;

class DisplayController extends MainController {
    
    //Основной блок с данными для отображения
    protected $mainbar;
    protected $lang;
    protected $lang_prefix;
    protected $langList;
    protected $uri;

    public function __construct($container) { 
            parent::__construct($container);
            $this->lang = $this->getLang();
            $this->lang_prefix = $this->getLangPrefixUrl($_SESSION['lang']);
            $this->langList = $this->getLangUrl();
            $this->uri = $this->getUri();
    }

    //Получение префикса языка для URL. Если используется язык по умолчанию, в uri его не будет. Язык по умолчанию
    //указывается в файле конфигурации config.php
    protected function getLangPrefixUrl ($prefix) {
        if ($prefix != DEFAULT_LANG) {
                return $prefix;
        }
    }

    //Получение из базы список локаций (используемых языком) для вывода на каждой странице для возможности переключения.
    protected function getLangUrl () {
            $data = $this->model->getLang();
                    foreach ($data as &$item) {
                        if ($item['alias'] == DEFAULT_LANG) {
                                unset($item['prefix']);
                        }
                    }
            return $data;
    }

    //Получение файла локализации для выбранного языка
    public function getLang () {
            $data = require_once $_SERVER['DOCUMENT_ROOT'].'/lang/'.$_SESSION['lang'].'.php';
        return $data;
    }
    
    //Метод получения uri для правильного вывода ссылок на странице с учетом возможности переключения языка (локации)
    protected function getUri () {  
        $data = trim($_SERVER['REQUEST_URI'], '/');       
        $data = explode('/', $data);
        if (in_array($data[0], LANG)) {
            array_shift($data);
            return implode('/', $data);
        }else {
            return implode('/', $data);
        }   
    }

    // Вывод на экран
    protected function display() {       
            echo $this->view->render('index.php', [   
                                                            'mainbar' => $this->mainbar,
                                                            'langTempl' => $this->lang,
                                                            'title' => $this->lang['title'],
                                                            'langData' =>$this->langList,
                                                            'uri' => $this->uri
                                                        ]);   
        }

    protected function JsonResponse () {
            
        }
}
