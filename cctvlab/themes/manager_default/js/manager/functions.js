$(document).ready(function(){

	$(".open-top-content").click(function(){
                $("#top-content-2").slideUp("slow");
		$("#top-content").slideToggle("slow");
                
		return false;
	});
        
        $(".open-top-content-2").click(function(){
		
                $("#top-content").slideUp("slow");
                $("#top-content-2").slideToggle("slow");
		return false;
	});
        
        $(".closable").append('<a href="#" class="close">close</a>');

        $("a.close").click(function () {
                $(this).fadeTo(200,0); 
                $(this).parent().fadeTo(200,0);
                $(this).parent().slideUp(400);
                return false;
        });

        $(".notification").fadeIn("slow");
        
        $('input.calendar').simpleDatepicker({ x: 0, y: 0});
         
});

