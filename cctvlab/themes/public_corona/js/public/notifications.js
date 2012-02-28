$(document).ready(function() {
		
   $(".closable").append('<a href="#" class="close">close</a>');
   
   $("a.close").click(
           function () {
               $(this).fadeTo(200,0);
               $(this).parent().fadeTo(200,0);
               $(this).parent().slideUp(400);
               return false;});
    
    $(".notification").fadeIn("slow");  
    
});