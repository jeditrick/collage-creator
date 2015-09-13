<!DOCTYPE html>
<html>
<head>
        <style>

        *{
            font-family: "Arial Black", Arial, Tahoma, sans-serif,serif;
        }

        #content{
            text-align: center;
            margin: 2% auto;
        }
        .result{
            background: rgba(0,0,0,0.3);
        }
        input{
            margin: 15px;

        }
        input{
            width: 300px;
            padding: 5px;
            font-size: 16px;
            border: 0;
            border-bottom: 2px solid black;
        }
        input:focus{
            outline: 0;
        }
        [type="submit"]{
            outline: 0;
            width: 150px;
            height: 50px;
            border: 0;
            box-shadow: 0  3px 3px rgba(0,0,0,0.3);
        }
        [type="submit"]:hover{

            color: gray;
        }

    </style>
</head>
<body>
<div id = "content" style="width: {{size}}px; height: {{size}}px;">
    {% block content %}
    {% endblock %}
</div>
<div id = "footer">
</div>
<script src = "//code.jquery.com/jquery-1.11.3.min.js"></script>
</body>
</html>