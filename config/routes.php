<?php
        return
                    ['GET' =>
                                [
                                    'index'             => 'profileuser/execute',
                                    'index/([aA-zZ]+)'  => 'index/execute',
                                    'register'          => 'register/register',
                                    'login'             => 'login/login'
                                ],
                     'POST' =>
                                [
                                    'checkMail' => 'admin/mail'
                                ]
                    ];
