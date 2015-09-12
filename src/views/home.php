{% extends "base.php" %}
{% block content %}
<div >
    <form action="result" method="get">
        <label for="url">Enter url : </label>
        <br>
        <input type="text" id="url" name="login">
        <br>
        <input type="submit" value="Send">
    </form>
    <a id="result">

</div>

</div>
{% endblock %}