<!-- Форма выхода, если пользователь авторизирован -->
<div class="center">
    <p>{{lang.message_auth}}</p>
    <a href="{{uriPage.home}}">{{lang.page_profile}}</a> 
    <p>
        <a class="btn btn-danger" id ="logout_button">{{lang.logout}}</a>
    </p>
</div>
<script>    
    var url = '{{uriPage.logout}}';  
</script>

