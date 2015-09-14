<!DOCTYPE html>
<html>
<head>
    <title>UWC8</title>
    <link rel="stylesheet" href="/resources/css/style.css">
    <script src = "//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/resources/js/html2canvas.js"></script>
</head>
<body>
<div id = "content" style="width: {{size}}px; height: {{size}}px;">
    {% block content %}
    {% endblock %}
</div>

</body>
</html>