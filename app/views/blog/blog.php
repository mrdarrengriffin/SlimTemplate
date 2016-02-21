{% extends 'templates/default.php' %}

{% block title %}Blog{% endblock %}

{% block content %}
<div class="blog-container">
  {% if auth.hasPermission('blog.create-posts') %}
  <form action="{{ urlFor('blog.create-post.post') }}" method="post">
    <div class="panel panel-default">
      <div class="panel-heading">Create Blog Post</div>
      <div class="panel-body">
        <div class="form-group char-count" data-limit='255'>
          <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
          {% if errors.first('title') %}This field is required{% endif %}
        </div>
        <div class="form-group">
          <label for="ckeditor">Content</label>
          <textarea name="content" id="ckeditor" required></textarea>
          {% if errors.first('content') %}This field is required{% endif %}
        </div>
        {% if config.get('social.reddit.enabled') %}
        <div class="form-group" style="margin-bottom:5px;">
          <label for="reddit-link">Reddit Discussion URL</label>
          <div class="input-group">
            <span class="input-group-addon">Reddit Thread Shortlink</span>
            <input type="text" class="form-control" name="reddit-link" id="reddit-link" placeholder="e.g. https://redd.it/3i2ffz" required>
          </div>
          {% if errors.first('reddit-link') %}This field is required{% endif %}
        </div>
        {% endif %}
      </div>
      <div class="panel-footer text-right">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <input type="submit" class="btn btn-sm btn-success" value="Create Post">
      </div>
    </div>
  </form>
  <hr>
  {% endif %}

  {% if blogItems.count == 0 %}
  <h1 class="text-center">No blog posts yet!</h1>
  <h4 class="text-center text-muted">We shall post some soon though! Hold Tight!</h4>
  {% endif %}

  {% for b in blogItems %}
  <div class="blog-item">
    <div class="blog-heading">
      <span class="blog-title">{{ b.title }}</span>
      <span class="blog-subtitle">posted by <strong>{{ b.user.username }}</strong> on <strong>{{ b.timestamp_created | date("F jS, Y") }}</strong> at <strong>{{ b.timestamp_created | date("H:ia") }}</strong></span>
    </div>
    <div class="blog-content">{{ b.content | raw }}</div>
    <div class="blog-item-footer">

      {% if config.get('social.reddit.enabled') and b.getAttributeByName('reddit-link') %}
      <span class="blog-discuss-reddit"><a href="{{ b.getAttributeByName('reddit-link') }}">Discuss this post on Reddit</a></span>
      {% endif %}
    </div>
  </div>
  {% endfor %}
</div>
{% endblock %}
