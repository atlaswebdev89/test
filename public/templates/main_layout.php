<!DOCTYPE html>
<html lang="ru">    
<head>
    {% block header %}
        {% include 'header.php' %}
    {% endblock %}
</head>
<body>
    <div class="container">
        <nav  class="navbar">
                <div id="navbar">
                        {% for data in langData %}                      
                                {% if data.alias == usedLang %}
                                    <a href="{{data.prefix}}"><img src="{{data.icon}}" class = "activeLang"></a>                                    
                                {% else %}
                                    <a href="{{data.prefix}}"><img src="{{data.icon}}"></a>
                                {% endif %}                                  
                    {% endfor %}   
                  <span><strong>{{langTempl.language}}</strong></span>
                </div>
        </nav>
        
        <div class="row flex-md-vmiddle">
            <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2">
                {% block content %}
                {% endblock %}                                            
            </div>          
        </div>
    </div>
            {% block scripts %}
                    {% include 'footer.php' %}
            {% endblock %}
</body>
</html>
