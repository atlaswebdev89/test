<!-- Форма авторизации -->
<h1 class="dark text-center">{{lang.title_page_login}}</h1>
    <form>
        <label>{{lang.labelLogin}}</label>
        <input type="text" name="login" placeholder="{{lang.placeholderLogin}}" required="required">
        <label>{{lang.labelPass}}</label>
        <input type="password" name="password" placeholder="{{lang.placeholderPass}}" required="required">
        <button id="loginButton" type="submit">{{lang.enter}}</button>
        <p>
            {{lang.questionAccaunt}} - <a href="{{uriPage.register}}">{{lang.submitRegister}}</a>          
        </p>
                <p class="msg none"></p>
    </form>
<script>
    var url = '{{uriPage.checkUsers}}';
</script>
