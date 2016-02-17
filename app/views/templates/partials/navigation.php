
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ application_name | raw }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ urlFor('home') }}">Home</a></li>
      </ul>
	  {% if authEnabled %}
      <ul class="nav navbar-nav navbar-right">
        {% if auth %}
        
        {% if auth.hasPermission('admin.tab.show') %}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Tools <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Information</li>
            <li><a href="{{ urlFor('admin.info') }}">Dashboard</a></li>
            <li class="dropdown-header">User Tools</li>
            <li><a href="{{ urlFor('admin.users') }}">Manage Users</a></li>
          </ul>
        </li>
        {% endif %}
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth.getFullNameOrUsername() }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Account Preferences</li>
            <li><a href="{{ urlFor('account.changePassword') }}">Change Password</a></li>
            <li><a href="{{ urlFor('account.profile') }}">Update Profile</a></li>
            <li class="dropdown-header">Current Session</li>
            <li><a href="{{ urlFor('logout') }}">Logout</a></li>
          </ul>
        </li>
        <li style="padding:0;margin-right:-15px;padding-left:7px;"><img style="margin:5px;border-radius:4px;margin-left:-1px;" src="{{ auth.getAvatarUrl({size:40}) }}"></li>
        {% else %}
        <li><a href="{{ urlFor('login')}}">Login</a></li>
        <li><a href="{{ urlFor('register')}}">Register</a></li>
        {% endif %}
      </ul>
	  {% endif %}
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
