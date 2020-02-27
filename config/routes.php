<?php
        return
                    ['GET' =>
                                [
                                    'index'             => 'profileuser/profile',
                                    'index/([aA-zZ]+)'  => 'index/execute',
                                    'register'          => 'register/register',
                                    'login'             => 'login/login'
                                ],
                     'POST' =>
                                [
                                    'checkMail'     => 'admin/mail',
                                    'checkUsers'    => 'login/checkUsers',
                                    'logout'        => 'login/logout',
                                    'registerUsers' => 'register/registerUsers',
                                    'checkLogin'    => 'register/checkLogin'
                                ]
                    ];
