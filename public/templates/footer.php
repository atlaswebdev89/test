<script src="/js/jquery-2.1.4.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/inputFile.js"></script>
<!--Скрипт ajax авторизации на сайте -->
<script src="/js/singAjax.js"></script>
<!--Скрипт log out на сайте -->
<script src="/js/logout.js"></script>
<!-- Скрипт замены стандартного alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Передача JSON данных переводов в зависимости от локализации -->
<script>    
    //Убираем экранирование Twig с помощью raw
    var lang = {{langOut | raw }};    
</script>

