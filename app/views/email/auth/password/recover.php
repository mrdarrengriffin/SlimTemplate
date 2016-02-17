{% extends 'email/templates/default.php' %}
{% block content %}
<p>You requsted a password reset</p>

<p>Click this link to reset your password: {{ base_url }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier | url_encode }}</p>
{% endblock %}
