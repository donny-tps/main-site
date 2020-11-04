$=jQuery;
$(document).ready(function() {
   $('.btn-ph').click(function () { 
     elementClick = $(this).attr("href");
     destination = $(elementClick).offset().top;
     if($.browser.safari){
       $('body').animate( { scrollTop: destination }, 3000 );
     }else{
       $('html').animate( { scrollTop: destination }, 3000 );
     }
     return false;
   });
 });