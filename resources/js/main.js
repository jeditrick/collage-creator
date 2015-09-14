$(window).load (
    function(){
        html2canvas(document.getElementById('result'), {
            onrendered: function (canvas) {
                $('#result').replaceWith(canvas);
            },
            allowTaint: true,
            taintTest: false,
            async: false
        });
    }
);
