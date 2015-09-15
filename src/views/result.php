{% extends "base.php" %}
{% block content %}
<a href="{{go_back}}">Go back</a>
{% if not empty %}
<ul style="text-align: left">
    <li>Right mouse click on collage</li>
    <li>Save image as...</li>
</ul>
<div id="result">
    {% for item in info %}
    <img width="{{item['info']['size']+5}}%" height="{{item['info']['size']+5}}%"
         src="{{item['info']['profile_image_url']}}" alt="">
    {% endfor %}
</div>
<script src="resources/js/main.js"></script>
{% else %}
<h1>User is empty</h1>
{% endif %}
{% endblock %}