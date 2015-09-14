{% extends "base.php" %}
{% block content %}
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

<script>
//    $(document).ready(
//        function () {
//            html2canvas(document.getElementById('result'), {
//                onrendered: function (canvas) {
//                    $('#result').html(canvas);
//                    $(canvas).attr('id','canvas')
//                },
//                allowTaint: true
//            });
//        }
//    );
//
//    $('#download').click(
//        function(){
//            this.href = document.getElementById('canvas').toDataURL();
//            this.download = 'collage.png';
//        }
//    );


</script>
{% endblock %}