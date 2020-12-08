$(document).ready(function(){

$(".newsType").change(function () {

    if($(this).val() === "image"){
        $(".videoContainer").hide();
        $(".imageContainer").fadeIn();
    }else if($(this).val() === "video"){
        $(".imageContainer").hide();
        $(".videoContainer").fadeIn();
    }
})

})
