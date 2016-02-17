{% if flash.count > 0 %}
{% if flash.success %}
<div class="alert alert-success" role="alert"><strong>Success:</strong> {{ flash.success | raw }}</div>
{% elseif flash.error %}
<div class="alert alert-danger" role="alert"><strong>Error:</strong> {{ flash.error | raw }}</div>
{% elseif flash.warning %}
<div class="alert alert-warning" role="alert"><strong>Oops:</strong> {{ flash.warning | raw }}</div>
{% endif %}
{% endif %}
