   <!-- Форма регистрации -->
   <h1 class="dark text-center">{{lang.title_page_register}}</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label>{{lang.labelname}}<span class = "red"> *</span></label>
        <input type="text" name="name" placeholder="{{lang.placeholderName}}" required ="required">
        <label>{{lang.labellogin}}<span class = "red"> *</span></label>
        <input type="text" id="login" name="login" placeholder="{{lang.placeholderLogin}}" required ="required">
        <label>{{lang.email}}<span class = "red"> *</span></label>
        <input type="email" name="email" placeholder="{{lang.placeholderEmail}}" required ="required" >
            
        <label>{{lang.profileImage}}</label>
            <div class="upload_form">
                <label class="label-input">
                    <input name="file" type="file" class="main_input_file" />
                    <div class="label-input">{{lang.InputFile}}</div>
                    <input class="f_name" name = "file1" type="text" id="f_name" value="{{lang.InputFileMessage}}" disabled />
                </label>
            </div>        
        <label>{{lang.labelpassword}}<span class = "red"> *</span></label>
        <input type="password" name="password" placeholder="{{lang.placeholderPass}}" required ="required">
        <label>{{lang.labelConfirmPass}}<span class = "red"> *</span></label>
        <input type="password" name="password_confirm" placeholder="{{lang.placeholderConfirmPass}}" required ="required">
        <button id = "registerButton" type="submit">{{lang.submitRegister}}</button>
        <p>
                {{lang.questionAccauntRegister}} - <a href="{{uriPage.login}}">{{lang.loginSite}}</a>           
        </p>
    </form>
   <script>
       var uri = '{{uriPage.registerUsers}}';
   </script>
 
   

   
   
