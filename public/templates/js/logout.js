jQuery(document).ready(function ($) {
        $("#logout_button").click(function (event) {
            event.preventDefault();
            ConfirmSweet(ajaxdatasend, $(this));
        })
})

function ConfirmSweet(nameFunc, button) {
    swal({
        title: "Выйти",
        text: "Вы точно хотите покинуть сайт?",
        icon: "warning",
        buttons: ["Остаться", "Выйти!"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                nameFunc(button);
            }
        });
}

function ajaxdatasend (button){
    $.ajax ({
        type: 'POST',
        url:url,
        data: {logout:true},
        timeout: 5000,
        //Указывая тип json использовать функцию JSON.parse не надо будет ошибка
        dataType: "json",
        beforeSend: function (data) {
            //Блокируем кнопку и элементы формы
            button.attr('disabled', 'disabled');
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