$(function(){

            var minFocal = $("#focal_min_val").val();
            var maxFocal = $("#focal_max_val").val();

            if (!minFocal & !maxFocal)
            {
               maxFocal = 200;
               minFocal = 0;
            }

            $("#focal-val-min").val(minFocal);
            $("#focal-val-max").val(maxFocal);
            $("#focal_slider").slider({
                min: 0,
                max: 200,
                range: true,
                animate: true,
                values: [minFocal, maxFocal],
                slide: function(event,ui) {update(ui.values[0], ui.values[1])}
            });
            $("#focal_min_val").keypress(function (e){
                var key_min = String.fromCharCode(e.which);
                $("#focal_slider").slider("values", 0, $("#focal_min_val").val() + key_min);
            });
            $("#focal_max_val").keypress(function (e){
                var key_max = String.fromCharCode(e.which);
                $("#focal_slider").slider("values", 1, $("#focal_max_val").val() + key_max);
            });

    function update(min, max)
            {
                $("#focal_min_val").val(min);
                $("#focal_max_val").val(max);
                $("#focal-val-min").val(min);
                $("#focal-val-max").val(max);
            }



})