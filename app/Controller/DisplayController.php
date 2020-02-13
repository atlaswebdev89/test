<?php

namespace Controller;

class DisplayController extends MainController {
    
    //Основной блок с данными для отображения
    protected $mainbar;
    protected $lang;
    protected $lang_prefix;
    protected $langList;

    public function __construct($container) { 
            parent::__construct($container);
            $this->lang = $this->getLang();
            $this->lang_prefix = $this->getLangPrefixUrl($_SESSION['lang']);
            $this->langList = $this->getLangUrl();
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

    // Вывод на экран
    protected function display() {       
            echo $this->view->render('index.php', [   
                                                            'mainbar' => $this->mainbar,
                                                            'langTempl' => $this->lang,
                                                            'title' => $this->lang['title'],
                                                            'langData' =>$this->langList
                                                        ]);   
        }


    protected function JsonResponse () {
            
        }
}
