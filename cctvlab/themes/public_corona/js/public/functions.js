
$(document).ready(function() {

   $('.dropdown-toggle').dropdown()

    var arr = [];

   $('table.zebra tr').each(function(i, it){

      if(i % 2 == 0) {

         $(this).addClass('even');
      }
   })

   function test(obj)
   {
       arr.push(obj);
       alert(arr);
   }
   
});
