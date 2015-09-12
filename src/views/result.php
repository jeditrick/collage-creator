{% extends "base.php" %}
{% block content %}

{% for item in info %}
    <img  src="{{item['info']['profile_image_url']}}" alt="">
{% endfor %}

{% endblock %}