$(function(){
    
})
function add_to_compare(lenses_id, button_id)
{
    $.ajax({
        async: true,
        type: 'post',
        url: '/lenses/add_to_comparing',
        data: {lenses_id: lenses_id},
        success: function(data){
            data = JSON.parse(data)
            if (data.status == 'success')
            {
                $("#button_to_compare"+button_id).fadeOut('slow');
            }
        }
    })
}