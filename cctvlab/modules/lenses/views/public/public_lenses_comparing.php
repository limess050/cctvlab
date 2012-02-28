<script type="text/javascript">
    $(document).ready(function () {

        $("select").change(function () {

            var lenses_id_left  = $("select[name=lenses_left]").val();
            var lenses_id_right = $("select[name=lenses_right]").val();
            var test_id_left    = $("select[name=test_left]").val();
            var test_id_right   = $("select[name=test_right]").val();
            $.ajax({
                async:true,
                type:"POST",
                url:"/lenses/comparing",
                beforeSend: function() {$("#charts").html('');  $("#charts").addClass('loading_ajax')},
                complete: function() {$("#charts").removeClass('loading_ajax'); group_id_left = null; group_id_right = null},
                data:{
                    lenses_id_left:     lenses_id_left,
                    lenses_id_right:    lenses_id_right,
                    test_id_left:       test_id_left,
                    test_id_right:      test_id_right
                },
                success:function (data, textStatus) {
                    var data = JSON.parse(data);
                    if (data.status == 'success') {
                        $("#charts").html(data.html);
                    }
                    else {
                        alert(data.html);
                    }
                }
            })
        });

        var data = JSON.parse($("input[name=json_left]").val());
        var factor = 40;
        var MaxAperture_left    = (data.left.items[0] - 1) * factor;
        var MaxFocal_left       = (data.left.items[1] - 1) * factor;
        var chart_left          = data.left.charts[0][0];

        var MaxAperture_right   = (data.right.items[0] - 1) * factor;
        var MaxFocal_right      = (data.right.items[1] - 1) * factor;
        var chart_right         = data.right.charts[0][0];
        //---------Левый график-------------//

                 //--Разрешение--//

        var container1_1 = $("#chart_1_left");
        var plot1_1 = new Highcharts.Chart({
            chart:{
                renderTo:container1_1[0],
                defaultSeriesType:'spline'
            },
            title:{
                text:'Разрешающая способность'
            },
            subtitle:{
                text:''
            },
            xAxis:{
                min: 0,
                max: 101,
                title:{
                    text: 'Расстояние от центра кадра, %'
                }
            },
            yAxis:{
                min: 0,
                max: <?php echo isset($data['y_max']) ? $data['y_max'] + 100 : 'null' ?>,
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
                                lineWidth: 1
                            }
                        }
                    }
                }
            },
            legend: false,
            series:[
                {
                    name:'График',
                    data:chart_left.points
                }
            ]
        });

                 //---Кривизна---//

        //if (chart_left.curvature_points != '[0,0]')
            //chart_left.curvature_points = chart_left.curvature_points.reverse();
        var container1_2 = $("#chart_2_left");
        var plot1_2 = new Highcharts.Chart({
            chart:{
                renderTo:container1_2[0],
                defaultSeriesType:'spline',
                inverted: true
            },
            title:{
                text:'Кривизна поля фокуса'
            },
            subtitle:{
                text:''
            },
            xAxis:{
                title:{
                    test: 'Расстояние от центра кадра, %'
                },
                max: 100
            },
            yAxis:{
                max: <?php echo isset($data['y_curvature_max']) ? $data['y_curvature_max'] + 0.05: 'null' ?>,
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
                    lineWidth: 2,
                    states: {
                        hover: {
                            lineWidth: 2
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
            legend: false,
            series:[
                {
                    name:'График',
                    data:chart_left.curvature_points
                }
            ]
        });

        //---------Правый график-----------//

                 //--Разрешение--//

        var container2_1 = $("#chart_1_right");
        var plot2_1 = new Highcharts.Chart({
            chart:{
                renderTo:container2_1[0],
                defaultSeriesType:'spline'
            },
            title:{
                text:'Разрешающая способность'
            },
            subtitle:{
                text:''
            },
            xAxis:{
                min: 0,
                max: 101,
                title:{
                    text: 'Расстояние от центра кадра, %'
                }
            },
            yAxis:{
                min: 0,
                max: <?php echo isset($data['y_max']) ? $data['y_max']  + 100 : 'null'?>,
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
                                lineWidth: 1
                            }
                        }
                    }
                }
            },
            legend: false,
            series:[
                {
                    name:'График',
                    data:chart_right.points
                }
            ]
        });

                 //---Кривизна---//

        if (chart_right.curvature_points != '[0,0]')
            chart_right.curvature_points = chart_right.curvature_points.reverse();
        var container2_2 = $("#chart_2_right");
        var plot2_2 = new Highcharts.Chart({
            chart:{
                renderTo:container2_2[0],
                defaultSeriesType:'spline',
                inverted: true
            },
            title:{
                text:'Кривизна поля фокуса'
            },
            subtitle:{
                text:''
            },
            xAxis:{

                title:{
                    test: 'Расстояние от центра кадра, %'
                },
                max: 100
            },
            yAxis:{
                max: <?php echo isset($data['y_curvature_max']) ? $data['y_curvature_max'] + 0.05: 'null' ?>,
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
                    lineWidth: 2,
                    states: {
                        hover: {
                            lineWidth: 2
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
            legend: false,
            series:[
                {
                    name:'График',
                    data:chart_right.curvature_points
                }
            ]
        });


        //---------Левая крутилка-------------//

        $("#aperture-val-left").val(chart_left.aperture);
        $("#focal-val-left").val(chart_left.focal);

        $("#aperture-slider-left").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxAperture_left,
            value:0,
            slide:function (event, ui) {
                update_left(ui.value, $("#focal-slider-left").slider("value"))
            }
        });
        $("#focal-slider-left").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxFocal_left,
            value:0,
            slide:function (event, ui) {
                update_left($("#aperture-slider-left").slider("value"), ui.value)
            }
        });
        function update_left(aperture, focal) {
            var chart_left = data.left.charts[parseInt(aperture / factor)][parseInt(focal / factor)];
            $("#aperture-val-left").val(chart_left.aperture);
            $("#focal-val-left").val(chart_left.focal);
            plot1_1.series[0].setData(chart_left.points);
            plot1_2.series[0].setData(chart_left.curvature_points);
        }

        //---------Правая крутилка------------//

        $("#aperture-val-right").val(chart_right.aperture);
        $("#focal-val-right").val(chart_right.focal);

        $("#aperture-slider-right").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxAperture_right,
            value:0,
            slide:function (event, ui) {
                update_right(ui.value, $("#focal-slider-right").slider("value"))
            }
        });
        $("#focal-slider-right").slider({
            range:"min",
            animate:true,
            min:0,
            max:MaxFocal_right,
            value:0,
            slide:function (event, ui) {
                update_right($("#aperture-slider-right").slider("value"), ui.value)
            }
        });
        function update_right(aperture, focal) {
            var chart_right = data.right.charts[parseInt(aperture / factor)][parseInt(focal / factor)];
            $("#aperture-val-right").val(chart_right.aperture);
            $("#focal-val-right").val(chart_right.focal);
            plot2_1.series[0].setData(chart_right.points);
            plot2_2.series[0].setData(chart_right.curvature_points);
        }
        if (data.left.items[1] == 1) $(".slidecontfocal-left").hide();
        if (data.left.items[0] == 1) $(".slidecontperture-left").hide();

        if (data.right.items[1] == 1) $(".slidecontfocal-right").hide();
        if (data.right.items[0] == 1) $(".slidecontperture-right").hide();
    });
// ------------------>>> Начало разметки <<<--------------------//
</script>
<div id="chart_cont" style="margin-left: -20px; *zoom: 1; ">
    <div id='lenses_left' style="float: left; margin-left: 20px; width: 300px; height: 500px;" >
        <div class="selected-comparing">
            <table>
                <tr>
                    <th width="50%" align="center"><?=lang('lenses_lenses')?>:</th>
                    <th width="50%" align="center"><?=lang('lenses_test_id')?>:</th>
                </tr>
                <tr>
                    <td width="50%"><?=$data['left']['select_lenses']?></td>
                    <td width="50%"><?=$data['left']['select_testing']?></td>
                </tr>
            </table>
        </div>
        <div class="description-comparing">
            <table>
                <tr>
                    <td>
                        <?php if ($data['left']['image']): ?>
                        <?php echo img(array('src' => $data['left']['image'][element(1, $this->config->item('lenses_thumb_size'))], 'width' => '40')); ?>
                        <?php else: ?>
                        <?php echo image_asset('none.png', 'lenses', array('width' => '70')); ?>
                        <?php endif;?>
                    </td>
                    <td>
                        <p>
                            <b><?php echo anchor('lenses/item/'.$data['left']['description']['lenses_id'], $data['left']['description']['lenses_model'] ? $data['left']['description']['lenses_model'] : '-');?></b>
                        </p>

                        <p><?php echo lang('lenses_parameters_focal');?>
                            :<?php echo element($data['left']['description']['lenses_parameters_focal'] ? $data['left']['description']['lenses_parameters_focal'] : 0, lang('lenses_parameters_focal_arr'));?></p>
                        <?php if ($data['left']['description']['lenses_parameters_focal'] == '2'): ?>
                        <p><?php echo lang('lenses_parameters_focal_min');?>
                            : <?php echo $data['left']['description']['lenses_parameters_focal_min'] ? $data['left']['description']['lenses_parameters_focal_min'] : '-';?></p>
                        <p><?php echo lang('lenses_parameters_focal_max');?>
                            : <?php echo $data['left']['description']['lenses_parameters_focal_max'] ? $data['left']['description']['lenses_parameters_focal_max'] : '-';?></p>
                        <?php else: ?>
                        <p><?php echo lang('lenses_parameters_focal_const');?>
                            : <?php echo $data['left']['description']['lenses_parameters_focal_min'] ? $data['left']['description']['lenses_parameters_focal_min'] : '-';?></p>
                        <?php endif; ?>
                        <p><?php echo lang('lenses_parameters_aperture_max');?>
                            : <?php echo $data['left']['description']['lenses_parameters_aperture_max'] ? $data['left']['description']['lenses_parameters_aperture_max'] : '-';?></p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="chart" align="center">
            <div id="chart_1_left" style="width:105%;height:300px; margin: 0 0 10px 0; " class="item"></div>
            <div id="chart_2_left" style="width:105%;height:300px; margin: 0 0 10px 0; margin-right: 10px" class="item"></div>
            <table width="100%" border="0">
                <tr>
                    <td width="50%">
                        <label for="amount" class="slide-left"><?php echo lang('lenses_focal');?>:</label><input
                        type="text" id="focal-val-left"
                        style="display: inline; margin-left: 3px; border:0; color:#f6931f; font-weight:bold; width: 20px;" readonly="true"/>
                        <div class="slidecontfocal-left">
                            <div id="focal-slider-left" class="slider"></div>
                        </div>
                    </td>
                    <td width="50%">
                        <label for="amount" class="slide-left"><?php echo lang('lenses_aperture');?>
                            :</label><input type="text" id="aperture-val-left"
                                            style="display: inline; margin-left: 3px; margin-top: 25px border:0; color:#f6931f; font-weight:bold; width: 20px;" readonly="true"/>
                        <div class="slidecontperture-left">
                            <div id="aperture-slider-left" class="slider"></div>
                        </div>
                    </td>

                </tr>
            </table>
            <input type="hidden" name="json_left" value='<?php echo json_encode($data); ?>'/>
        </div>
    </div>
    <div id='lenses_right' style="float: left; margin-left: 20px; width: 300px; ">
        <div class="selected-comparing">
            <table>
                <tr>
                    <th width="50%" align="center"><?=lang('lenses_lenses')?>:</th>
                    <th width="50%" align="center"><?=lang('lenses_test_id')?>:</th>
                </tr>
                <tr>
                    <td width="50%">
                        <?=$data['right']['select_lenses']?></td>
                    <td width="50%"><?=$data['right']['select_testing']?></td>
                </tr>
            </table>
        </div>
        <div class="description-comparing">
            <table>
                <tr>
                    <td>
                        <?php if ($data['right']['image']): ?>
                        <?php echo img(array('src' => $data['right']['image'][element(1, $this->config->item('lenses_thumb_size'))], 'width' => '40')); ?>
                        <?php else: ?>
                        <?php echo image_asset('none.png', 'lenses', array('width' => '70')); ?>
                        <?php endif;?>
                    </td>
                    <td>
                        <p>
                            <b><?php echo anchor('lenses/item/'.$data['right']['description']['lenses_id'], $data['right']['description']['lenses_model'] ? $data['right']['description']['lenses_model'] : '-');?></b>
                        </p>

                        <p><?php echo lang('lenses_parameters_focal');?>
                            :<?php echo element($data['right']['description']['lenses_parameters_focal'] ? $data['right']['description']['lenses_parameters_focal'] : 0, lang('lenses_parameters_focal_arr'));?></p>
                        <?php if ($data['right']['description']['lenses_parameters_focal'] == '2'): ?>
                        <p><?php echo lang('lenses_parameters_focal_min');?>
                            : <?php echo $data['right']['description']['lenses_parameters_focal_min'] ? $data['right']['description']['lenses_parameters_focal_min'] : '-';?></p>
                        <p><?php echo lang('lenses_parameters_focal_max');?>
                            : <?php echo $data['right']['description']['lenses_parameters_focal_max'] ? $data['right']['description']['lenses_parameters_focal_max'] : '-';?></p>
                        <?php else: ?>
                        <p><?php echo lang('lenses_parameters_focal_const');?>
                            : <?php echo $data['right']['description']['lenses_parameters_focal_min'] ? $data['right']['description']['lenses_parameters_focal_min'] : '-';?></p>
                        <?php endif; ?>
                        <p><?php echo lang('lenses_parameters_aperture_max');?>
                            : <?php echo $data['right']['description']['lenses_parameters_aperture_max'] ? $data['right']['description']['lenses_parameters_aperture_max'] : '-';?></p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="chart" align="center">
            <div id="chart_1_right" style="width:105%;height:300px; margin: 0 0 10px 0;" class="item"></div>
            <div id="chart_2_right" style="width:105%;height:300px; margin: 0 0 10px 0;" class="item"></div>
            <table width="100%" border="0">
                <tr>
                    <td width="50%">
                        <label for="amount" class="slide-right"><?php echo lang('lenses_focal');?>:</label><input
                        type="text" id="focal-val-right"
                        style=" margin-left: 3px; border:0; color:#f6931f; font-weight:bold; width: 20px;" readonly="true"/>
                        <div class="slidecontfocal-right">
                            <div id="focal-slider-right" class="slider"></div>
                        </div>
                    </td>
                    <td width="50%">

                        <label for="amount" class="slide-right"><?php echo lang('lenses_aperture');?>
                            :</label><input type="text" id="aperture-val-right"
                                            style=" margin-left: 3px;border:0; color:#f6931f; font-weight:bold; width: 20px;" readonly="true"/>
                        <div class="slidecontperture-right">
                            <div id="aperture-slider-right" class="slider"></div>
                        </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="json_right" value='<?php echo json_encode($data); ?>'/>
        </div>
    </div>
</div>





