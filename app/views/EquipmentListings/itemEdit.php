{% extends 'templates/default.php' %}

{% block title %}Edit Item in {{ item.client.name }}{% endblock %}

{% block content %}
<div class="panel panel-default">
	<div class="panel-heading">Client Details</div>
	<div class="panel-body">
		<form method="post" action="{{ urlFor('el.item.edit.post') }}" autocomplete="off">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Reference</label>
						<input type="text" disabled value="{{ item.id }}" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Make</label>
						<input type="text" value="{{ item.make }}" name="make" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Model</label>
						<input type="text" value="{{ item.model }}" name="model" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Description</label>
						<input type="text" value="{{ item.description }}" name="description" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Serial</label>
						<input type="text" value="{{ item.serial }}" name="serial" class="form-control">
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label>Item Asset Number</label>
						<input type="text" value="{{ item.asset_number }}" name="asset_number" class="form-control">
					</div>
				</div>
				
				
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Location</label>
						<select name="location_id" class="form-control">
							<option selected value="0"># Select A Location #</option>
							{% for l in locations %}
							<option value="{{ l.id }}" {% if l.id == item.location_id %}selected{% endif %}>{{ l.location_name }}</option>
							{% endfor %}
							
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="id" value="{{ item.id }}">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				<input type="submit" value="Save" class="btn btn-success pull-right">	
			</div>
		</form>
	</div>
</div>
{% endblock %}
