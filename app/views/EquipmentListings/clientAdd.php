{% extends 'templates/default.php' %}

{% block title %}Add new Client{% endblock %}

{% block content %}

<div class="panel panel-default">
	<div class="panel-body">
		<form method="post" action="{{ urlFor('el.client.add.post') }}" autocomplete="off">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Client Reference</label>
						<input type="text" disabled value="# Save First #" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Client Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Sage Account Reference</label>
						<input type="text" name="sage_acc" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Agreement Reference</label>
						<input type="text" name="agreement_ref" class="form-control" required>
					</div>
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				<input type="submit" value="Save" class="btn btn-success pull-right">
			</div>
		</form>
	</div>
</div>

{% endblock %}
