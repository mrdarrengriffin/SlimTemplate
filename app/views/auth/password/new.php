{% extends 'templates/default.php' %}

{% block title %}New Password{% endblock %}

{% block content %}
<div class="row">
	<div class="col-md-6">
		<form action="{{ urlFor('account.newPassword.post')}}" method="post" autocomplete="off" class="form-horizontal">
			<p>You are required to enter a new password.</p>
			
			<div class="form-group">
				<label for="new_password" class="col-sm-4 control-label">New Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="new_password" name="new_password">
				</div>
			</div>
			<div class="form-group">
				<label for="new_password_confirm" class="col-sm-4 control-label">Confirm New Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-10">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					
					<button type="submit" class="btn btn-default">Change Password</button>
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
