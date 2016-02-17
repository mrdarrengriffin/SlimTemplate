{% extends 'templates/default.php' %}

{% block title %}Location for {{ client.name }}{% endblock %}

{% block content %}
<div class="panel panel-default">
	<div class="panel-heading">Client Details</div>
	<div class="panel-body">
		<form method="post" action="{{ urlFor('el.location.add.post') }}" autocomplete="off">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Location Reference</label>
						<input type="text" disabled value="# Save First #" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Location Name</label>
						<input type="text" name="name" class="form-control">
					</div>
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="client_id" value="{{ client.id }}">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				<input type="submit" value="Save" class="btn btn-success pull-right">	
			</div>
		</form>
	</div>
</div>
{% endblock %}
