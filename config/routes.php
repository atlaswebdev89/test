<?php
        return
                    ['GET' =>
                                [
                                    '/'     => 'index/execute',
                                    'admin' => 'admin/index',
                                    'show'  => 'admin/show'
                                ],
                     'POST' =>
                                [
                                    'checkMail' => 'admin/mail'
                                ]
                    ];
