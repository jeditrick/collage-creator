{% extends "base.php" %}
{% block content %}
<div >
    <form action="result" method="get">
        <label for="login">Enter login : </label>
        <br>
        <input type="text" id="login" name="login">
        <br>
        <label for="size">Enter size : </label>
        <br>
        <input type="number" id="size" name="size">
        <br>
        <input type="submit" value="Send">
    </form>
    <a id="result">

</div>

</div>
{% endblock %}