jQuery(document).ready(function ($) {
    $('#registerButton').click(function (e) {
        var button = $(this);
        //Отменяем стандарное действие при нажатие на submit
        e.preventDefault();
        //Текущая форма
        var form = $(this).parents('form');
        //переменная formValid
        var formValid = true;

        $(".error").remove();
        $(".error-input").removeClass("error-input");

            //Проверка полей формы на соответстию шаблонам разрешенных символов
            form.find('input').each(function () {
                switch ($(this).attr('name')) {
                    //Проверка поля ввода Имя
                    case 'name':
                        //Проверка поля на пустоту
                        if (checkEmpty($(this).val())) {
                            formValid = false;
                            $(this).addClass('error-input');
                            break;
                        }
                        //Проверка на соотвествия длины
                        if ($(this).val().length < 3) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Имя не может быть короче 3 символов</span>');
                            break;
                        }

                        //Проверка на отсутствие спецсимволов
                        var regExSpec = /[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]+/;
                        if (regExSpec.test($(this).val())) {
                                formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Запрещенные символы</span>');
                            break;
                        }
                        break;

                    case 'login':

                        //Проверка поля на пустоту
                        if (checkEmpty($(this).val())) {
                            formValid = false;
                            $(this).addClass('error-input');
                            break;
                        }

                        //Проверка на соотвествия длины
                        if ($(this).val().length < 3) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Логин не может быть короче 3 символов</span>');
                            break;
                        }

                        //Проверка логина на соответсвие шаблона регулярного выражения
                        var regEx = /^\w+$/;
                        if (regEx.test($(this).val()) == 0) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Разрешенные символы: латинские буквы,цифры и знак подчеркивания</span>');
                            break;
                        }
                        break;

                    case 'email':
                        //Проверка поля на пустоту
                        if (checkEmpty($(this).val())) {
                            formValid = false;
                            $(this).addClass('error-input');
                            break;
                        }
                        //Проверка email на соответсвие шаблона регулярного выражения
                        var regEx = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
                        if (regEx.test($(this).val()) == 0) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Enter a valid email</span>');
                        }
                        break;

                    case 'password':
                        //Проверка поля на пустоту
                        if (checkEmpty($(this).val())) {
                            formValid = false;
                            $(this).addClass('error-input');
                            break;
                        }
                        //Минимальнная длина пароля 6 знаков
                        if ($(this).val().length < 5) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Длина пароля от 6 до 12 знаков</span>');
                            break;
                        }
                        break;

                    case 'password_confirm':
                        //Проверка поля на пустоту
                        if (checkEmpty($(this).val())) {
                            formValid = false;
                            $(this).addClass('error-input');
                            break;
                        }
                        //Минимальнная длина пароля 6 знаков
                        if ( ($(this).val().length < 5) || ($(this).val().length > 13) ) {
                            formValid = false;
                            $(this).addClass('error-input').after('<span class = "error red">Длина пароля от 6 до 12 знаков</span>');
                            break;
                        }
                        break;

                    case 'file':
                        if ($(this)[0].files[0]) {
                            //Проверка на соответствие типа файлу
                            var typeFiles = [
                                                'image/jpeg',
                                                'image/jpg',
                                                'image/png',
                                                'image/gif'
                                            ];
                            //Определяем размер файла
                            var file_size = ($(this)[0].files[0].size);
                            if (file_size > 5242880) {
                                formValid = false;
                                $(this).parents(".upload_form").addClass('error-input').after('<span class = "error red">Размер файла не должен превышать 5MB</span>');
                                break;
                            }
                            //Определяем тип файла
                            var type_file = ($(this)[0].files[0].type);
                            if ($.inArray(type_file, typeFiles) == -1) {
                                formValid = false;
                                $(this).parents('div.upload_form').addClass('error-input').after('<span class = "error red">Разрешенный формат jpg, jpeg, png, gif</span>');
                                break;
                            }
                        }
                        break;
                }
            })

        //Проверяем совпанение паролей
        if(formValid) {
            var Pass = form.find('input[name=password]').val();
            var ConfirmPass = form.find('input[name=password_confirm]').val();
            //Проверяем совпадение пароля и подтверждение пароля
            if (Pass != ConfirmPass) {
                    formValid = false;
                    form.find("p.msg").html('Пароли не совпадают Проверьте');
                    form.find("p.msg").css("color", "#000").fadeIn("slow");
                    setTimeout(function () {
                        $('p.msg').fadeOut("slow");
                    }, 3000);
                }
            }

        if (formValid) {
                var formData = new FormData(form[0]);
            ajaxRegister(form, formData);
        }
    })
})

//Функция проверки поля на пустоту
function checkEmpty(input) {
    //Проверка поля на пустоту
    if (input.length == 0) {
        return true;
    }
}

function ajaxRegister (form, formdata=null){
    $.ajax ({
        type: 'POST',
        url:uri,
        contentType: false,
        processData: false,
        data: formdata,
        timeout: 5000,
        //Указывая тип json использовать функцию JSON.parse не надо будет ошибка
        dataType: "json",
        beforeSend: function (data) {
            //Блокируем кнопку и элементы формы
            form.find('input, button').attr('disabled', 'disabled');
        },
        success:  function (data) {
            if(data) {
                if(data.status == true){
                    window.location.href = data.url;
                }else if (data.status == false){
                    //Включаем кнопку
                    form.find('input, button').removeAttr('disabled');
                    //Проверка ошибки передаче данных
                    if (data.message) {
                        form.find("p.msg").html(data.message);
                        form.find("p.msg").css("color", "#000").fadeIn("slow");
                        setTimeout(function () {
                            $('p.msg').fadeOut("slow");
                        }, 3000);
                    } else {
                        $.each(data.error, function () {
                            console.log($(this)[0].field);
                        });

                        for (var key in data.error){
                            form.find('input[name='+data.error[key].field+'], div.'+data.error[key].field).addClass('error-input').after('<span class = "error red">'+data.error[key].message+'</span>');
                        }
                    }

                }
            }
        }
    })
}