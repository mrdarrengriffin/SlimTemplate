{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block content %}
<p>Enter your email asscoiated to your account.</p>
<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
<div>
  <label for="email">Email</label>
  <input type="text" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
  {% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
</div>
<div>
  <input type="submit" value="Recover Password">
</div>
<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>
{% endblock %}
