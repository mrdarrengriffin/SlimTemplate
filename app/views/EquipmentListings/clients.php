{% extends 'templates/default.php' %}
{% set tmpItems = 0 %}


{% block title %}All Clients{% endblock %}

{% block content %}
<div class="panel panel-default">
	<div class="panel-heading">
		All Clients
		<a href="{{ urlFor('el.client.add') }}" class="btn btn-default btn-sm pull-right">Add Client</a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Client Name</th>				
				<th>Sage Account</th>				
				<th>Items</th>				
				<th>Agreement Reference</th>				
				<th>Tools</th>
				
			</tr>
		</thead>
		<tbody>
			{% for c in clients %}
			{% for i in c.items %}
			{% if i.enabled == 1 %}
			{% set tmpItems = tmpItems + 1 %}
			{% endif %}
			{% endfor %}
			
			<tr>
				<th scope="row">{{ c.id }}</th>
				<td><a href="{{ urlFor('el.client.view',{id:c.id}) }}">{{ c.name }}</a></td>
				<td>{{ c.sage_acc }}</td>
				<td>{{ tmpItems }}</td>
				<td>{{ c.agreement_ref }}</td>
				
				<td>
					<form style="display:inline-block;" method="post" id="{{ c.id }}-delete-frm" action="{{ urlFor('el.client.delete.post') }}" autocomplete="off">
						<input type="hidden" name="id" value="{{ c.id }}">
						<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					</form>
					<div class="btn-group" role="group">
						<a href="{{ urlFor('el.client.edit',{id:c.id}) }}" type="button" class="btn btn-xs btn-default">Edit</a>
						
						<button class="btn btn-xs btn-default" onclick="$('#{{c.id}}-delete-frm').submit()">Delete</button>
					</div>
					
					
				</td>
			</tr>
			{% set tmpItems = 0 %}
			{% endfor %}
		</tbody>
	</table>
</div>
{% endblock %}
