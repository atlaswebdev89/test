<?php
        return
                    ['GET' =>
                                [
                                    'index'             => 'profileuser/profile',                                   
                                    'register'          => 'register/register',
                                    'login'             => 'login/login'
                                ],
                     'POST' =>
                                [                                    
                                    'checkUsers'    => 'login/checkUsers',
                                    'logout'        => 'login/logout',
                                    'registerUsers' => 'register/registerUsers',
                                    'checkLogin'    => 'register/checkLogin'
                                ]
                    ];
