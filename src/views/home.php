{% extends "base.php" %}
{% block content %}
<div >
    <form action="result" method="post">
        <label for="login">Enter login : </label>
        <br>
        <input required type="text" id="login" name="login">
        <br>
        <label for="size">Enter size : </label>
        <br>
        <input type="number" min="0" id="size" name="size">
        <br>
        <input type="submit" value="Send">
    </form>
    <a id="result">

</div>

</div>
{% endblock %}