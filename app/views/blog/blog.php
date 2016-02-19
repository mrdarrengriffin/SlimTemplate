{% extends 'templates/default.php' %}

{% block title %}Blog{% endblock %}

{% block content %}
<div class="blog-container">

  {% if auth.hasPermission('blog.create-posts') %}

  {% endif %}

  {% if blogItems.count == 0 %}
  <h1 class="text-center">No blog posts yet!</h1>
  <h4 class="text-center text-muted">We shall post some soon though!</h4>
  {% endif %}

  {% for b in blogItems %}
  <div class="blog-item">
    <div class="blog-heading">
      <span class="blog-title">{{ b.title }}</span>
      <span class="blog-subtitle">posted by <strong>{{ b.user.username }}</strong> on <strong>{{ b.timestamp_created | date("F jS, Y") }}</strong> at <strong>{{ b.timestamp_created | date("H:ia") }}</strong></span>
    </div>
    <div class="blog-content">{{ b.content | raw }}</div>
    <div class="blog-item-footer">
      <span class="blog-discuss-reddit">Discuss this post on Reddit</span>
    </div>
  </div>
  {% endfor %}
</div>
{% endblock %}
