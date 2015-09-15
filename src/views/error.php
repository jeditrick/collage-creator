{% extends "base.php" %}
{% block content %}

{% if error_code == 404%}
    <h1>There is no info about this user ! Does he exist ????</h1><br/><a href="/">Go back</a>
{% elseif error_code == 429 %}
    <h1>Rate limit exceeded!!! Please try again later</h1><br/><a href="/">Go back</a>
{% else %}
    <h1>Something goes wrong ! :( Try again</h1><br/><a href="/">Go back</a>
{% endif %}
{% endblock %}