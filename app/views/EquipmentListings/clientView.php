{% extends 'templates/default.php' %}
{% block title %}{{ client.name }} - {{ client.sage_acc }}{% endblock %}
{% set totalItems = 0 %}

{% block content %}
<div class="row">
	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">Filter Items - {{ items.count }} Found</div>
			<div class="panel-body">
				<form>
					<div class="form-group form-group-sm">
						<label>Make</label>
						<select class="form-control" name="filter_make">
							<option value="">-- All --</option>
							{% for m in makes %}
							<option value="{{ m }}" {% if getparams['filter_make']== m %}selected{% endif %}>
								{{ m }}
							</option>
							{% endfor %}
						</select>
					</div>
					<div class="form-group form-group-sm">
						
						<label>Description</label>
						<div class="clear-control">
							<input type="text" name="filter_description" class="form-control" value="{{ getparams['filter_description'] }}"> 
							<span class="glyphicon glyphicon-remove input-clear"></span>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label>Location</label>
						<select class="form-control" name="filter_location">
							<option value="">-- All --</option>
							{% for l in locations %}
							<option value="{{ l.id }}" {% if getparams['filter_location']== l.id %}selected{% endif %}>
								{{ l.location_name }}
							</option>
							{% endfor %}
						</select>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label">Model</label>
						<div class="clear-control">
							<input type="text" name="filter_model" class="form-control" value="{{ getparams['filter_model'] }}">
							<span class="glyphicon glyphicon-remove input-clear"></span>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label">Serial</label>
						<div class="clear-control">
							<input type="text" name="filter_serial" class="form-control" value="{{ getparams['filter_serial'] }}">
							<span class="glyphicon glyphicon-remove input-clear"></span>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label">Asset</label>
						<div class="clear-control">
							<input type="text" name="filter_asset" class="form-control" value="{{ getparams['filter_asset'] }}">
							<span class="glyphicon glyphicon-remove input-clear"></span>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label">Sort By</label>
						<select class="form-control" name="sorting">
							<option value="">-- Default (ID) --</option>
							<option value="id" {% if getparams['sorting']== "id" %}selected{% endif %}>ID</option>
							<option value="make" {% if getparams['sorting']== "make" %}selected{% endif %}>Make</option>
							<option value="description" {% if getparams['sorting']== "description" %}selected{% endif %}>Description</option>
							<option value="model" {% if getparams['sorting']== "model" %}selected{% endif %}>Model</option>
							<option value="serial" {% if getparams['sorting']== "serial" %}selected{% endif %}>Serial</option>
							<option value="asset_number" {% if getparams['sorting']== "asset_number" %}selected{% endif %}>Asset Number</option>
						</select>
					</div>
					<div class="form-group form-group-sm">
						<label class="control-label">Sort Order</label>
						<select class="form-control" name="sort_order">
							<option value="asc" {% if getparams['sort_order']== "asc" %}selected{% endif %}>Ascending</option>
							<option value="desc" {% if getparams['sort_order']== "desc" %}selected{% endif %}>Descending</option>
						</select>
					</div>
					<div class="form-group form-group-sm">
						<a href="{{ urlFor('el.client.view',{id:client.id}) }}" class="btn btn-default btn-danger btn-xs">Clear Filters</a>
						<button type="submit" class="btn btn-default btn-success pull-right">Filter</button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-8">
		<div class="panel panel-default">
		<div class="panel-heading">
		All Clients
		<a href="{{ urlFor('el.print.items',{client_id:client.id}) }}" class="btn btn-default btn-sm pull-right">Print</a>
		<a href="{{ urlFor('el.item.add',{id:client.id}) }}" class="btn btn-default btn-sm pull-right">Add Item</a>
		<a href="{{ urlFor('el.location.add',{id:client.id}) }}" class="btn btn-default btn-sm pull-right">Add Location</a>
		</div>
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Make</th>
					<th>Description</th>
					<th>Model</th>
					<th>Serial</th>
					<th>Location</th>
					<th>Asset</th>
					<th>Tools</th>
					
				</tr>
			</thead>
			<tbody>
				{% for i in items %}
				{% if i.location.enabled == 1 %}
				{% set totalItems = totalItems + 1 %}
				<tr {% if i.enabled == 0 %}class="danger"{% endif %}>
					<th scope="row">{{ i.id }}</th>
					<td>{{ i.make }}</td>
					<td>{{ i.description }}</td>
					<td>{{ i.model }}</td>
					<td>{{ i.serial }}</td>
					<td>{{ i.location.location_name }}</td>
					<td>{{ i.asset_number }}</td>
					<td>
						{% if i.enabled == 0 %}
					<form style="" method="post" id="{{ i.id }}-undelete-frm" action="{{ urlFor('el.item.undelete.post') }}" autocomplete="off">
					<input type="hidden" name="id" value="{{ i.id }}">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					{% else %}
					<form style="" method="post" id="{{ i.id }}-delete-frm" action="{{ urlFor('el.item.delete.post') }}" autocomplete="off">
					<input type="hidden" name="id" value="{{ i.id }}">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					{% endif %}
					<form style="" method="post" id="{{ i.id }}-duplicate-frm" action="{{ urlFor('el.item.duplicate.post') }}" autocomplete="off">
					<input type="hidden" name="id" value="{{ i.id }}">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					<div class="btn-group" role="group">
					<a href="{{ urlFor('el.item.edit',{id:i.id}) }}" type="button" class="btn btn-xs btn-default">Edit</a>
					{% if i.enabled == 0 %}
					<button class="btn btn-xs btn-default" onclick="$('#{{i.id}}-undelete-frm').submit()">Un-Delete</button>
					{% else %}
					<button class="btn btn-xs btn-default" onclick="$('#{{i.id}}-delete-frm').submit()">Delete</button>
					{% endif %}
					<button class="btn btn-xs btn-default" onclick="$('#{{i.id}}-duplicate-frm').submit()">Duplicate</button>
					</div>
					</td>
					</tr>
					{% endif %}
					{% endfor %}
					</tbody>
					</table>
					<div class="panel-footer"><strong>Items: </strong>{{ totalItems }}</div>
					
					</div>
					</div>
					</div>
					{% endblock %}
										