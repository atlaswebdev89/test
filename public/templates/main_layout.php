<!DOCTYPE html>
<html lang="ru">    
<head>
    {% block header %}
        {% include 'header.php' %}
    {% endblock %}
</head>

<body>               
            {% block content %} 
            {% endblock %}
                 
            {% block scripts %}
                    {% include 'footer.php' %}
            {% endblock %}
</body>
</html>
