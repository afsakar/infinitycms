$(document).ready(function(){

    $('input[type="radio"]').click(function() {
        var inputValue = $(this).attr("value");
        if(inputValue == "1"){
            $(".btnContainer").fadeIn();
        }else{
            $(".btnContainer").fadeOut();
        }
    });

})
