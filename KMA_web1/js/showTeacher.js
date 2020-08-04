$(document).ready(function (){
    $(".search").click(function (){
        $(".show_result_TT").addClass("show");
        $(".show_result_TT").removeClass("hidden");
        $(".show_result_lichday").addClass("hidden");
        $(".show_result_lichday").removeClass("show");
        
    });
   
}); 
$(document).ready(function (){
    
 $(".ld").click(function (){
        $(".show_result_lichday").addClass("show");
        $(".show_result_lichday").removeClass("hidden");
        $(".show_result_TT").addClass("hidden");
        $(".show_result_TT").removeClass("show");
        
    });
   
}); 