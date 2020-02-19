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
                                    'checkMail' => 'admin/mail',
                                    'checkUsers' => 'login/checkUsers'
                                ]
                    ];
