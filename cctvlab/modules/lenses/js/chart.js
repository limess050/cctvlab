$(function () {

    var factor = 40;
    var test_id = '';
    var data = JSON.parse($.ajax({async:false,
        type:"post",
        url:"/lenses/export/",
        data:{test_id:test_id, lenses_code:$("input[name=lenses_code]").val()}
    }).responseText);
    if (data.items[0] == '1') {
        $("#aperture-slider").hide();
    }
    if (data.items[1] == '1') {
        $("#focal-slider").hide();
    }
    if (data.status == 'success') {
        var MaxAperture = (data.items[0] - 1) * factor;
        var MaxFocal = (data.items[1] - 1) * factor;
        var chart = data.charts[0][0];

        var container = $("#chart")
        var plot = new Highcharts.Chart({
            chart:{
                renderTo:container[0],
                defaultSeriesType:'spline',
                shadow: true,
                inverted: false
            },
            title:{
                text:'CCTVLAB.ru'
            },
            subtitle:{
                text:'Разрешающая способность объектива'
            },
            xAxis:{
                title:{
                    text:'Расстояние от центра кадра, %'
                },
                reversed: false
            },
            yAxis:{
                min: 0,
                title:{
                    text:'Разрешение(линий на высоту кадра)'
                }
            },
            tooltip:{
                enabled:true,
                formatter:function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        'X = ' + this.x + ' Y = ' + this.y;
                }
            },
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                symbol: 'circle',
                                radius: 5,
                                lineWidth: 5
                            }
                        }
                    }
                }
            },
            exporting: {
                enabled: false
            },
            series:[
                {
                    name:'График',
                    data: chart.points
                }
            ]
        });

        var plot2 = new Highcharts.Chart({
            chart:{
                renderTo:'chart2',
                defaultSeriesType:'spline',
                shadow: true,
                inverted: true
            },
            title:{
                text:'CCTVLAB.ru'
            },
            subtitle:{
                text:'Кривизна поля фокуса'
            },
            xAxis:{
                title:{
                    text:'Расстояние от центра кадра, %'
                }
            },
            yAxis:{
                title:{
                    text:'Отклонение, %'
                }
            },
            tooltip:{
                enabled:true,
                formatter:function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        'X = ' + this.x + ' Y = ' + this.y;
                }
            },
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                symbol: 'circle',
                                radius: 5,
                                lineWidth: 1
                            }
                        }
                    }
                }
            },
            series:[
                {
                    name:'График',
                    data:chart.curvature_points
                }
            ]
        });
        $("#aperture-val").html(chart.aperture);
        $("#focal-val").html(chart.focal);

        $("#aperture-slider").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxAperture,
            value:0,
            slide:function (event, ui) {
                update(ui.value, $("#focal-slider").slider("value"))
            }
        });


        $("#focal-slider").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxFocal,
            value:0,
            slide:function (event, ui) {
                update($("#aperture-slider").slider("value"), ui.value)
            }
        });
    }
    else {
        $(".chart").hide();
    }

    function update(aperture, focal) {
        var chart = data.charts[parseInt(aperture / factor)][parseInt(focal / factor)];
        plot.series[0].setData(chart.points);
        plot2.series[0].setData(chart.curvature_points);
        $("#aperture-val").html(chart.aperture);
        $("#focal-val").html(chart.focal);
    }

});
