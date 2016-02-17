{% extends 'templates/default.php' %}

{% block title %}Edit {{ client.name }}{% endblock %}

{% block content %}
<div class="panel panel-default">
	<div class="panel-heading">Client Details</div>
	<div class="panel-body">
		<form method="post" action="{{ urlFor('el.client.edit.post') }}" autocomplete="off">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Client Reference</label>
						<input type="text" disabled value="{{ client.id }}" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Client Name</label>
						<input type="text" value="{{ client.name }}" name="name" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Sage Account Reference</label>
						<input type="text" value="{{ client.sage_acc }}" name="sage_acc" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Agreement Reference</label>
						<input type="text" value="{{ client.agreement_ref }}" name="agreement_ref" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="id" value="{{ client.id }}">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				<input type="submit" value="Save" class="btn btn-success pull-right">	
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">Client Locations
		<a href="{{ urlFor('el.location.add',{id:client.id}) }}" class="btn btn-info btn-sm pull-right">Add Location</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Location Name</th>
				<th>Items</th>
				<th>Tools</th>
			</tr>
		</thead>
		<tbody>
			{% for l in locations%}
			<tr>
				<th scope="row">{{ l.id }}</th>
				<td>{{ l.location_name}}</td>
				<td>{{ l.items.count}}</td>
				<td>
					{% if l.enabled == 0 %}
					<form style="display:inline-block;" method="post" id="{{ l.id }}-undelete-frm" action="{{ urlFor('el.location.undelete.post') }}" autocomplete="off">
						<input type="hidden" name="id" value="{{ l.id }}">
						<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					{% else %}
					<form style="display:inline-block;" method="post" id="{{ l.id }}-delete-frm" action="{{ urlFor('el.location.delete.post') }}" autocomplete="off">
					<input type="hidden" name="id" value="{{ l.id }}">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					{% endif %}
					<div class="btn-group" role="group">
						<a href="{{ urlFor('el.location.edit',{id:l.id}) }}" type="button" class="btn btn-xs btn-default">Edit</a>
						{% if l.enabled == 0 %}
						<button class="btn btn-xs btn-default" onclick="$('#{{l.id}}-undelete-frm').submit()">Un-Delete</button>
						{% else %}
						<button class="btn btn-xs btn-default" onclick="$('#{{l.id}}-delete-frm').submit()">Delete</button>
						{% endif %}
					</div>					
				</td>
			</tr>
			{% endfor %}
		</tbody>
	</table>
	</div>
	{% endblock %}
		