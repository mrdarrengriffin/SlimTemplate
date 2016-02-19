<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="lt-ie7"> <![endif]-->
<!--[if IE 7]>     <html class="lt-ie8"> <![endif]-->
<!--[if IE 8]>     <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{% block title %}Default Title{% endblock %} | {{ application_name }}</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.0.0-alpha1.js"></script>
		<script src="{{ base_url }}/public/assets/js/custom.js"></script>
		<script src="{{ base_url }}/public/assets/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="{{ base_url }}/public/assets/css/bootstrap.min.css" rel="stylesheet" media="all" />
		<link rel="stylesheet" href="{{ base_url }}/public/assets/css/theme.css">
		<link rel="icon" type="image/png" href="{{ base_url }}/icon.png">
		<script src="{{ base_url }}/assets/zero/ZeroClipboard.js"></script>
		<script src="{{ base_url }}/assets/ckeditor/ckeditor.js"></script>

	</head>

	{% block body %}
	<body>
		{% endblock %}
		{% block container %}
		<div class="container" style="padding-top: 20px;">
			{% endblock %}
			{% block hideNav %}
			{% include 'templates/partials/navigation.php' %}
			{% include 'templates/partials/messages.php' %}
			{% endblock %}

			<h3>{{ block('title') }}</h3>

			{% block content %}{% endblock %}
			{% include 'templates/partials/footer.php' %}
		</body>

	</html>
