{% extends "base.php" %}
{% block content %}
<div class="result">
    {% for item in info %}
    <img width="{{item['info']['size']}}%" height="{{item['info']['size']}}%" src="{{item['info']['profile_image_url']}}" alt="">
    {% endfor %}

</div>

{% endblock %}