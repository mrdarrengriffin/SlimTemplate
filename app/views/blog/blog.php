{% extends 'templates/default.php' %}

{% block title %}Blog{% endblock %}

{% block content %}
This is the blog page

<div class="blog-container">
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
