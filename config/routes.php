<?php
        return
                    ['GET' =>
                                [
                                    'index'             => 'index/execute',
                                    'index/([aA-zZ]+)'  => 'index/execute',
                                    'admin'             => 'index/execute',
                                    'admin/[aA-zZ]+'    => 'index/execute',
                                    'register'          => 'login/register',
                                    'login'             => 'login/login',
                                    'profile'           => 'profileuser/execute'
                                ],
                     'POST' =>
                                [
                                    'checkMail' => 'admin/mail'
                                ]
                    ];
