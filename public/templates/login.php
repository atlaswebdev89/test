<!-- Форма авторизации -->
<h1 class="dark text-center">{{lang.title_page_login}}</h1>
    <form action="#" method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>
            {% if lang_prefix %}
                    У вас нет аккаунта? - <a href="/{{lang_prefix}}/register">Зарегистрируйтесь</a>!
            {% else %}
                    У вас нет аккаунта? - <a href="/register">Зарегистрируйтесь</a>!
            {% endif %}
        </p>
                <p class="msg"> MESSAGE </p>
    </form>

