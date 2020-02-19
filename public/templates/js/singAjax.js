//Функция отправки данных на сервер
function ajaxData (form, formdata=null) {
    $.ajax ({
        type: 'POST',
        url:url,
        contentType: false,
        processData: false,
        data:formdata,
        timeout: 5000,
        //Указывая тип json использовать функцию JSON.parse не надо будет ошибка
        dataType: "json",
        beforeSend: function (data) {
            //Блокируем кнопку и элементы формы
            form.find('button,input').attr('disabled', 'disabled');
        },
        success:  function (data) {
            if(data) {
                //Если аутентификация прошла перенаправляем на страницу входа
                if(data.status == true){
                    window.location.href = data.url;
                }else {
                    //Очистка формы
                    form[0].reset();
                    //Включение кнопки и элементов формы
                    form.find('button,input').removeAttr('disabled');
                    form.find("p.msg").html(data.message);
                    form.find("p.msg").css("color", "#000").fadeIn("slow");
                    setTimeout(function () {
                        $('p.msg').fadeOut("slow");
                    }, 3000);
                }
            }
        },
        error: function(x, t, e){
            if( t === 'timeout') {
                // Произошел тайм-аут
                //Очистка формы
                form[0].reset();
                //Включение кнопки и элементов формы
                form.find('button,input').removeAttr('disabled');
                form.find("p.msg").html('Превышено время ожидания');
                form.find("p.msg").css("color", "#000").fadeIn("slow");
                setTimeout(function() { $('p.msg').fadeOut("slow"); }, 3000);
            }
        }
    })
}

jQuery(document).ready(function ($) {
    $('#loginButton').click(function (e) {
        //Текущая форма
        var form =  $(this).parents('form');
        //Отменяем стандарное действие при нажатие на submit
        e.preventDefault();
        //переменная formValid
        var formValid = true;

        //Проверка полей формы
        form.find('input').each(function () {
            if (this.checkValidity()) {
                    $(this).removeClass('error-input');
            }else {
                $(this).addClass('error-input');
                formValid = false;
            }
        });
        //Если ошибок валидации нет формируем объект данных и выполняем ajax запрос на сервер
        if (formValid) {
                form.find("p.msg").addClass('none');
                //формируем объект данных
                var formData = new FormData();
                form.find('input').each(function () {
                    formData.append($(this).attr('name'), $(this).val());
                });
                //Отправка данных на сервер через Ajax
                ajaxData(form,formData);
        }
    })
});