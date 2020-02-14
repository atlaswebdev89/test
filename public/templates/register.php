   <!-- Форма регистрации -->
   <h1 class="dark text-center">{{lang.title_page_register}}</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label>{{lang.labelname}}</label>
        <input type="text" name="name" placeholder="{{lang.placeholderName}}">
        <label>{{lang.labellogin}}</label>
        <input type="text" name="login" placeholder="{{lang.placeholderLogin}}">
        <label>{{lang.email}}</label>
        <input type="email" name="email" placeholder="{{lang.placeholderEmail}}">
        <label>{{lang.profileImage}}</label>
            <input type="file" name="avatar" >
        <label>{{lang.labelpassword}}</label>
        <input type="password" name="password" placeholder="{{lang.placeholderPass}}">
        <label>{{lang.labelConfirmPass}}</label>
        <input type="password" name="password_confirm" placeholder="{{lang.placeholderConfirmPass}}">
        <button type="submit">{{lang.submitRegister}}</button>
        <p>
            {% if lang_prefix %}
                {{lang.questionAccauntRegister}} - <a href="/{{lang_prefix}}/login">{{lang.loginSite}}</a>
            {% else %}
                {{lang.questionAccauntRegister}} - <a href="/login">{{lang.loginSite}}</a>
            {% endif %}
        </p>
    </form>

