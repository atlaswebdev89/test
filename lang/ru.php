<?php

return
    [
        'description' => 'Описание действия',
        'notFound' => 'Страница не найдена',       
        'language' => 'Русский',

        //Форма авторизации
        'title_page_login' => 'Авторизация',
        'labelLogin' => 'Логин',
        'placeholderLogin' =>'Введите свой логин',
        'labelPass' => 'Пароль',
        'placeholderPass' => 'Введите пароль',
        'enter' => 'Войти',
        'questionAccaunt' => 'У вас нет аккаунта?',
        'register' => 'Зарегистрируйтесь',

        //Форма регистрации
        'title_page_register' => 'Регистрация',
        'labelname' => 'Имя',
        'placeholderName' => 'Введите свое  имя',
        'labellogin'=>'Логин',
        'placeholderLogin' => 'Введите свой логин',
        'email' => 'Почта',
        'placeholderEmail'=>'Введите адрес своей почты',
        'profileImage'=>'Изображение профиля',
        'labelpassword'=>'Пароль',
        'placeholderPass' => 'Введите пароль',
        'labelConfirmPass'=>'Подтверждение пароля',
        'placeholderConfirmPass'=>'Подтвердите пароль',
        'questionAccauntRegister' => 'У вас уже есть аккаунт?',
        'submitRegister' => 'Зарегистрироваться',
        'loginSite'=>'Авторизоваться',
        'InputFile' => 'Выберите файл...',
        'InputFileMessage' => 'Файл не выбран',
        
        //Страница ошибки 404
        'page_not_found' => 'Cтраница не найдена',
        'linkHome' =>'Перейти на главную страницу',

        //Авторизация, сообщения для JS
        'message_no_auth' => 'Проверьте введенный данные',
        'message_no_login' => 'Данного пользователя не существует',
        
        //Страница logout
        'message_auth' => 'Вы уже авторизованы на сайте',
        'logout' => 'Выход',
        'page_profile' => 'Страница профиля',

        //Страница профиля
        'message_account' => 'Аккаунт',
        'message_name' => 'Имя',
        'message_email' => 'E-mail',
        
        //Сообщения для logout
        'message_alert' => 'Выйти',
        'message_alert_text' => 'Вы точно хотите покинуть сайт?',
        'message_alert_exit' => 'Выйти!',
        'message_alert_no_exit' => 'Остаться',

        //Валидация данных для JS
        'valid_name_length' => 'Имя не может быть короче 3 символов',
        'valid_name_pattern' => 'Запрещенные символы',
        'valid_login_length'=>'Логин не может быть короче 3 символов',
        'valid_login_pattern'=>'Разрешенные символы: латинские буквы,цифры и знак подчеркивания',
        'valid_email_pattern'=>'Не верный email адрес',
        'valid_pass_length'=>'Длина пароля от 6 до 12 знаков',
        'valid_img_size'=>'Размер файла не должен превышать 5MB',
        'valid_img_type'=>'Разрешенный формат jpg, jpeg, png, gif',
        'valid_compar_pass'=>'Пароли не совпадают!',

        //Переводы для Register class PHP
        'error_post_data_register'=>'Ошибка передачи данных. Попробуйте позже',
        'error_register_new_user' =>'Ошибка регистрации нового пользователя',

        //Переводы для класса валидации PHP
        'valid_back_name_empty' => 'Не заполнено поле Логина',
        'valid_back_name_length' => 'Длина должна быть больше 3 символов',
        'valid_back_name_deny'=>'Запрещенные символы',
        'valid_back_login_empty'=>'Не заполнено поле Логина',
        'valid_back_login_length'=>'Длина логина должна быть больше 3 символов',
        'valid_back_login_pattern'=>'Разрешенные символы: латинские буквы,цифры и знак подчеркивания',
        'valid_back_login_not_free'=>'Логин занят',
        'valid_back_email_empty'=>'Не заполнено поле email',
        'valid_back_email_pattern'=>'Не правильный формат почтового ящика',
        'valid_back_email_not_free'=>'Почта уже используется ',
        'valid_back_pass_empty'=> 'Обязательно для заполнения',
        'valid_back_pass_length'=>'Пароль не менее 6 символов',
        'valid_back_pass_not_rus'=>'Нельзя русские буквы в пароле',
        'valid_back_file_error'=>'Ошибка загрузки',
        'valid_back_file_deny_extension'=>'Выбраное расширение запрещено для загрузки',
        'valid_back_file_deny_type'=>'Можно только изображения',
        'valid_back_file_size'=>'Файл превышает допустимый размер. Разрешено до 5 МБ',
























    ];

