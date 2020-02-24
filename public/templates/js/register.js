jQuery(document).ready(function ($) {
    $('#registerButton').click(function (e) {
        var button = $(this);
        //Отменяем стандарное действие при нажатие на submit
        e.preventDefault();
        //Текущая форма
        var form = $(this).parents('form');
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

        if (formValid) {
            var formData = new FormData(form[0]);
            ajaxRegister(form, formData);
        }
    })
})

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
            form.find('input').attr('disabled', 'disabled');
        },
        success:  function (data) {
            if(data) {
                if(data.status == true){
                    window.location.href = data.url;
                }else if (data.status == false){
                    swal("Ошибка", "Ошибка logout", "error");
                    button.removeAttr('disabled');
                }
            }
        }
    })
}