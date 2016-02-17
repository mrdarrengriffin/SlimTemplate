{% extends 'templates/default.php' %}

{% block title %}Blog{% endblock %}

{% block content %}
This is the blog page

{% for b in blogItems %}
{{ b }}
{% endfor %}
{% endblock %}
