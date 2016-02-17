{% extends 'templates/default.php' %}

{% block title %}Blog{% endblock %}

{% block content %}
This is the blog page

{% if showEditor %}I will show the editor{% endif %}
{% endblock %}
