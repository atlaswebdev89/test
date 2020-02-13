<!DOCTYPE html>
<html lang="ru">    
<head>
    {% block header %}
        {% include 'header.php' %}
    {% endblock %}
</head>

<body>
    <nav  class="navbar navbar-fixed-top" style="padding:30px;">
            <div id="navbar" class="navbar-left">
                    {% for data in langData %}
                        {% if data.prefix %}
                            <a href="/{{data.prefix}}/login"><img src="{{data.icon}}"></a>
                        {% else %}
                            <a href="/login"><img src="{{data.icon}}"></a>
                        {% endif %}
                    {% endfor %}
                <span><strong>{{langTempl.language}}</strong></span>
            </div>
    </nav>

    <div class="container">
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
