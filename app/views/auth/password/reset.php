{% extends 'templates/default.php' %}

{% block title %}Reset Password{% endblock %}

{% block content %}
<form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier | url_encode }}" method="post" autocomplete="off">
	<div>
		<label for="new_password">Enter new passsword</label>
		<input type="password" name="new_password" id="new_password">
		{% if errors.has('new_password') %}
		<span id="h1" class="help-block">{{ errors.first('new_password')}}</span>
		{% endif %}
	</div>
	<div>
		<label for="new_password_confirm">Confirm new passsword</label>
		<input type="password" name="new_password_confirm" id="new_password_confirm">
        {% if errors.has('new_password_confirm') %}
		<span id="h1" class="help-block">{{ errors.first('new_password_confirm')}}</span>
		{% endif %}
		
	</div>
	<div>
		<input type="submit" name="name" value="Change password">
	</div>
	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	
</form>
{% endblock %}
