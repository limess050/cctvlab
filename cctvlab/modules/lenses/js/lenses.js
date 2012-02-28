$(function(){
    $("select[name=lenses_parameters_focal]").change(function (){
        if ($(this).val() == 1){
            $("#parameters_focal_min").hide();
            $("#parameters_focal_max").hide();
            $("#parameters_focal_const").show();
        }
        else{
            $("#parameters_focal_min").show();
            $("#parameters_focal_max").show();
            $("#parameters_focal_const").hide();
        }
    });



})
function set_focal_type (flag){

    if (flag == 'const'){
        $("#parameters_focal_min").hide();
        $("#parameters_focal_max").hide();
        $("#parameters_focal_const").show();
    }
    else{
        $("#parameters_focal_min").show();
        $("#parameters_focal_max").show();
        $("#parameters_focal_const").hide();
    }
}

function add_to_compare(lenses_id)
{
    $.ajax({
        async: true,
        type: 'post',
        url: '/lenses/add_to_comparing',
        data: {lenses_id: lenses_id},
        success: function(data){
            data = JSON.parse(data);
            if (data.status == 'success')
            {
                $("#to_compare"+lenses_id).removeClass("btn btn-dunger")
                $("#to_compared"+lenses_id).addClass("btn btn-success disabled");
                $("#to_compared"+lenses_id).html('Добавлено')
                //$("#to_compare"+lenses_id).fadeOut('fast');
                //$("#complete_compare"+lenses_id).show();
            }
        }
    })
}