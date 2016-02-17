{% extends 'templates/default.php' %} {% block title %}Manage User{% endblock %} {% block content %}
<form action="{{ urlFor('admin.user.update') }}" method="post" autocomplete="off" class="form-horizontal">
	
	<div class="col-sm-6">
		<div class="form-group">
			<label for="id" class="col-sm-4 control-label">User ID</label>
			<div class="col-sm-8">
				{{ user.id }}
				<input type="hidden" name="id" value="{{ user.id }}">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="username" class="col-sm-4 control-label">Username</label>
			<div class="col-sm-8">
				<input type="text" id="username" class="form-control" value="{{ user.username }}" name="username">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="fname" class="col-sm-4 control-label">First Name</label>
			<div class="col-sm-8">
				<input type="text" id="fname" class="form-control" value="{{ user.first_name }}" name="fname">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="lname" class="col-sm-4 control-label">Last Name</label>
			<div class="col-sm-8">
				<input type="text" id="lname" class="form-control" value="{{ user.last_name }}" name="lname">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<input type="email" id="email" class="form-control" value="{{ user.email }}" name="email">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="new_password" class="col-sm-4 control-label">Set New Password</label>
			<div class="col-sm-8">
				<input type="password	" id="new_password" class="form-control" name="new_password">
			</div>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group">
			<label for="banned" class="col-sm-4 control-label">Banned</label>
			<div class="col-sm-8">
				<input type="checkbox" id="banned" name="banned" {% if user.is_banned == 1 %}checked{% endif %} value="1">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="active" class="col-sm-4 control-label">Active</label>
			<div class="col-sm-8">
				<input type="checkbox" id="active" name="active" {% if user.active == 1 %}checked{% endif %} value="1">
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="require_password" class="col-sm-4 control-label">Require New Password</label>
			<div class="col-sm-8">
				<input type="checkbox" id="require_password" name="require_password" {% if user.require_new_password == 1 %}checked{% endif %} value="1">
			</div>
		</div>
	</div>



<div class="form-group">
	
	<div class="col-sm-12">
		<hr>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		
		<input type="submit" class="btn btn-success " value="Update user details">
		<hr>
	</div>
</form>
	
	<div class="col-sm-12">
		<div class="form-group">
			<label for="new_password" class="col-sm-2 control-label">Permissions</label>
			<div class="col-sm-10">
				{% for p,v in user.permissionsAsArray %}
				<form action="{{ urlFor('admin.user.permissions.delete') }}" method="post" autocomplete="off" style="display:inline-block;">
					<div class="btn-group">
						<button type="button" readonly class="btn btn-xs btn-info">{{p}}</button>
						<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
						<input type="hidden" name="permission_node" value="{{p}}">
						<input type="hidden" name="user_id" value="{{user.id}}">							
						<button type="submit" class="btn btn-xs btn-info dropdown-toggle">
							<span class="glyphicon glyphicon-remove"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
					</div>
				</form>
				{% endfor %}
				<hr>
				<form action="{{ urlFor('admin.user.permissions.add') }}" method="post" autocomplete="off" class="form-horizontal">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					
					<div class="input-group">
						<input type="text" class="form-control input-sm" name="permission_node" placeholder="Add permission node">
						<input type="hidden" name="user_id" value="{{user.id}}">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>

{% endblock %}
