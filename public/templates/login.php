<!-- Форма авторизации -->
<h1 class="dark text-center">{{lang.title_page_login}}</h1>
    <form action="#" method="post">
        <label>{{lang.labelLogin}}</label>
        <input type="text" name="login" placeholder="{{lang.placeholderLogin}}">
        <label>{{lang.labelPass}}</label>
        <input type="password" name="password" placeholder="{{lang.placeholderPass}}">
        <button type="submit">{{lang.enter}}</button>
        <p>
            {% if lang_prefix %}
                    {{lang.questionAccaunt}} - <a href="/{{lang_prefix}}/register">{{lang.register}}</a>
            {% else %}
                    {{lang.questionAccaunt}} - <a href="/register">{{lang.register}}</a>
            {% endif %}
        </p>
                <p class="msg"> MESSAGE </p>
    </form>

