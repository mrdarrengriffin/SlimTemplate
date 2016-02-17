{% extends 'templates/default.php' %}

{% block title %}Manage Users{% endblock %}

{% block content %}

<table class="table table-striped">
  <thead>
  <tr>
    <th>User ID</th>
    <th>Name</th>
    <th>Profile Image</th>
    <th>Email</th>
    <th>Accepted User Permissions</th>
    <th>Banned?</th>
    <th>Active?</th>
    <th></th>
  </tr>
</thead>
<tbody>
{% for u in allUsers %}
  <tr>
    <td>{{ u.id }}</td>
    <td>{{ u.first_name }} {{ u.last_name }}</td>
    <td><img src="{{ u.getAvatarUrl({size:42}) }}"></td>
    <td>{{ u.email }}</td>
    <td>{% for p,v in u.permissionsAsArray %}<span class="label label-default">{{p}}</span>{% endfor %}</td>
    <td>{% if u.is_banned == 1 %}Yes{% else %}No{% endif %}</td>
    <td>{% if u.active == 1 %}Yes{% else %}No{% endif %}</td>
    <td><a href="{{ urlFor('admin.user',{id:u.id})}}">Edit User</a></td>
  </tr>
  {% endfor %}
</tbody>
</table>

{% endblock %}
