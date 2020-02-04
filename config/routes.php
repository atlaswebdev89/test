<?php
        return
                    ['GET' =>
                                [
                                    'index' => 'index/execute',
                                    'admin' => 'index/execute'
                                ],
                     'POST' =>
                                [
                                    'checkMail' => 'admin/mail'
                                ]
                    ];
