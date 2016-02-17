{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}
{% block content %}
<div class="row">
	<div class="col-md-6">
		<form action="{{ urlFor('login.post')}}" method="post" autocomplete="off" class="form-horizontal">
			
			<div class="form-group">
				<label for="username" class="col-sm-4 control-label">Username</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="username" name="username">
					{% if errors.has('username') %}
					<span id="h1" class="help-block">{{ errors.first('username')}}</span>
					{% endif %}
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="password" name="password">
					{% if errors.has('password') %}
					<span id="h1" class="help-block">{{ errors.first('password')}}</span>
					{% endif %}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="checkbox" name="remember" id="remember"> Remember Me
					
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					<button type="submit" class="btn btn-success">Login</button>
					<a href="{{ urlFor('password.recover') }}" class="btn btn-default pull-right">Forgot your password?</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<h3>Data Protection</h3>
		<p>
			To comply with the <a href="https://en.wikipedia.org/wiki/Data_Protection_Act_1998">Data Protection Act 1998</a>, we do not store any passwords without going through an encryption process.
		</p>
	</div>
</div>

{% endblock %}
