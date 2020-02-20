<div class="col-md-12 center">
    <img src="{{user.foto}}" class="img-responsive img-thumbnail"  alt="Аватар пользователя">
</div>
<div class="col-md-12 profile">
    <p><strong>{{lang.message_account}}</strong> - {{user.login}}</p>
    <p><strong>{{lang.message_name}}</strong> - {{user.name}}</p>
    <p><strong>{{lang.message_email}}</strong> - {{user.email}}</p>
</div>
<div class="col-md-12 center">
    <a href="{{uriPage.logout}}" class="btn btn-danger" id ="logout_button">{{lang.logout}}</a>
</div>
<script>
    var url = '{{uriPage.logout}}';
</script>



