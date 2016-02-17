{% extends 'templates/default.php' %}

{% block title %}{% endblock %}
{% block hideNav %}{% endblock %}
{% block body %}<body onload="window.print()">{% endblock %}
	{% block container %}<div class="container-fluid">{% endblock %}
		{% block content %}
		<style>
			*{font-size:10px;}
			@media print {
			thead {display: table-header-group;}
			}
		</style>	
		<div class="row">
			<div class="col-sm-6">
				<strong>Client: </strong>{{ client.name }}<br>
				<strong>Item Count: </strong>{{ items.count }}
			</div>
			<div class="col-sm-6 text-right">
				<strong>Agreement Reference: </strong>{{ client.agreement_ref }}<br>
				<strong>Date of entry: </strong>{{ client.created_timestamp | date("d/m/Y") }}<br>
				<strong>Input by: </strong>Darren
			</div>
		</div>
		<hr>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Make</th>
								<th>Description</th>
								<th>Model</th>
								<th>Serial</th>
								<th>Location</th>
								<th>KLS Asset</th>
							</tr>
						</thead>
						<tbody>
							{% for i in items %}
							<tr {% if i.enabled == 0 %}class="danger"{% endif %}>
								<th scope="row">{{ i.id }}</th>
								<td>{{ i.make }}</td>
								<td>{{ i.description }}</td>
								<td>{{ i.model }}</td>
								<td>{{ i.serial }}</td>
								<td>{{ i.location.location_name }}</td>
								<td>{{ i.asset_number }}</td>
							</tr>
							{% endfor %}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		{% endblock %}
		