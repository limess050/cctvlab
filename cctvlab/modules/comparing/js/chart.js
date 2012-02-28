$(function () {

    $("select[name=lenses]").change(function () {

        var ChartId = $(this).prev("input[name=chart_id]").val();
        var LensesCode = $(this).val();
        var data = JSON.parse($.ajax({async:false,
            type:"post",
            url:"/lenses/export/",
            data:{lenses_code:LensesCode}
        }).responseText);

        if (data.status == 'success') {
            var factor = 40;
            var MaxAperture = (data.items[0] - 1) * factor;
            var MaxFocal = (data.items[1] - 1) * factor;
            var chart = data.charts[0][0];
            var plot = $.plot($("#" + ChartId), [
                {data:chart.points}
            ], {series:{shadowSize:2}, yaxis:{min:0, max:3000}, xaxis:{min:0, max:100}});

            $("#aperture-val-" + ChartId).val(chart.aperture);
            $("#focal-val-" + ChartId).val(chart.focal);

            $("#aperture-slider-" + ChartId).slider({
                range:"min",
                animate:true,
                min:0,
                max:MaxAperture,
                value:0,
                slide:function (event, ui) {
                    update(ui.value, $("#focal-slider-" + ChartId).slider("value"), data, factor, plot, ChartId)
                }
            });

            $("#focal-slider-" + ChartId).slider({
                range:"min",
                animate:true,
                min:0,
                max:MaxFocal,
                value:0,
                slide:function (event, ui) {
                    update($("#aperture-slide-" + ChartId).slider("value"), ui.value, data, factor, plot, ChartId)
                }
            });
        }
        else {
            $.plot($("#" + ChartId), [
                {}
            ], {series:{shadowSize:2}, yaxis:{min:0, max:3000}, xaxis:{min:0, max:100}});
        }
    });

    $.plot($("#first"), [
        {}
    ], {series:{shadowSize:2}, yaxis:{min:0, max:3000}, xaxis:{min:0, max:100}});
    $.plot($("#second"), [
        {}
    ], {series:{shadowSize:2}, yaxis:{min:0, max:3000}, xaxis:{min:0, max:100}});

    $("#aperture-val-first").val(0);
    $("#focal-val-first").val(0);

    $("#aperture-val-second").val(0);
    $("#focal-val-second").val(0);

    $("#aperture-slider-first").slider({
        range:"min",
        animate:true,
        min:0,
        max:0,
        value:0
    });

    $("#focal-slider-first").slider({
        range:"min",
        animate:true,
        min:0,
        max:0,
        value:0
    });

    $("#aperture-slider-second").slider({
        range:"min",
        animate:true,
        min:0,
        max:0,
        value:0
    });

    $("#focal-slider-second").slider({
        range:"min",
        animate:true,
        min:0,
        max:0,
        value:0
    });

    function update(aperture, focal, data, factor, plot, ChartId) {
        console.log(data.charts);
        var chart = data.charts[parseInt(aperture / factor)][parseInt(focal / factor)];

        $("#aperture-val-" + ChartId).val(chart.aperture);
        $("#focal-val-" + ChartId).val(chart.focal);
        //alert(chart.curvature_points);
        plot.setData([chart.points]);
        plot.draw();
    }
});
