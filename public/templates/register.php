   <!-- Форма регистрации -->
   <h1 class="dark text-center">{{lang.title_page_register}}</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label>{{lang.labelname}}<i style="color: red;"> *</i></label>
        <input type="text" name="name" placeholder="{{lang.placeholderName}}" required ="required">
        <label>{{lang.labellogin}}</label>
        <input type="text" name="login" placeholder="{{lang.placeholderLogin}}" required ="required">
        <label>{{lang.email}}</label>
        <input type="email" name="email" placeholder="{{lang.placeholderEmail}}" required ="required" >
            
        <label>{{lang.profileImage}}</label>
            <div class="upload_form">
                <label class="label-input">
                    <input name="file" type="file" class="main_input_file" />
                    <div class="label-input">{{lang.InputFile}}</div>
                    <input class="f_name" type="text" id="f_name" value="{{lang.InputFileMessage}}" disabled />
                </label>
            </div>        
        <label>{{lang.labelpassword}}</label>
        <input type="password" name="password" placeholder="{{lang.placeholderPass}}" required ="required">
        <label>{{lang.labelConfirmPass}}</label>
        <input type="password" name="password_confirm" placeholder="{{lang.placeholderConfirmPass}}" required ="required">
        <button id = "registerButton" type="submit">{{lang.submitRegister}}</button>
        <p>
                {{lang.questionAccauntRegister}} - <a href="{{uriPage.login}}">{{lang.loginSite}}</a>           
        </p>
    </form>
   <script>
       var uri = '{{uriPage.registerUsers}}';
   </script>
 
   

   
   
