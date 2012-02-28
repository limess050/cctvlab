$(function () {

    var lenses_id_left = '';
    if ($("select[name=default_left]").val())
        lenses_id_left = $("select[name=default_left]").val();
    else
        lenses_id_left = 'default';

	$.ajax({
           async: true,
           type: "POST",
           url: "/lenses/comparing",
           data: {lenses_id_left: $("input[name=default_left]").val(), lenses_id_right: $("input[name=default_right]").val()},
           beforeSend: function() {$("#charts").addClass('loading_ajax')},
           complete: function() {$("#charts").removeClass('loading_ajax')},
           success: function (data, textStatus) {
               var data = JSON.parse(data);
               if (data.status == 'success')
			   {
                    $("#charts").html(data.html);
			   }
               else
			   {
                    alert(data.html);
			   }
           }
		 })



    $("#loading").hide();


    $("#loading").bind("ajaxSend", function(){
    $("#loading").show();
    }).bind("ajaxComplete", function(){
    $("#loading").hide();
});
    
})
function compare(lenses_id, side, name)
 {
        var lenses_id_left = null;
        var lenses_id_right = null;


        if(side == 'left')
        {
            lenses_id_left = lenses_id;
            lenses_id_right = $("select[name=lenses_right]").val();
        }
        if(side == 'right')
        {
            lenses_id_right = lenses_id;
            lenses_id_left = $("select[name=lenses_left]").val();
        }
        $.ajax({
            async: true,
            type: "POST",
            url: "/lenses/comparing",
            beforeSend: function() {$("#charts").html('');  $("#charts").addClass('loading_ajax')},
            complete: function() {$("#charts").removeClass('loading_ajax')},
            data: {
                lenses_id_left: lenses_id_left,
                lenses_id_right: lenses_id_right
            },
            success: function (data, textStatus) {
                var data = JSON.parse(data);
                if (data.status == 'success')
                {    
					$("select[name=lenses]").val(name).change();
                    $("#charts").html(data.html);
                }
                else
				{
					alert(data.html);
				}
            }
        });
}
