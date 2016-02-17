{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block content %}
<strong>KLS (UK) Ltd</strong> Routine Service Listings Application v2.6<br>
<strong>Allowed IPs: </strong><br>{{ config.maintenance.allowed_ips | join(",") }}
{% endblock %}
