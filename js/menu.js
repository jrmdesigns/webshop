var orignalSource;
window.onload = function(){
    $("#menu-button").click(function(){
            $("#sub-menu").fadeToggle(500);
            $("#sub-menu").css("display", "flex");
            
            $("#menu-button > li > i").toggleClass("fa-caret-up");
    });



    $("#user-menu-button").click(function(){
        $("#user-menu").slideToggle(300);
        $("#user-menu-button > li > i").toggleClass("fa-caret-up");
    });


    $('.product-item').mouseover(function() {
        // var output = filename1.substr(0, filename1.lastIndexOf('.')) || filename1;
   
        orignalSource = $(this).find("img").attr('src');
        var editSource = orignalSource.split('.');
        var outputSource = editSource[0] + "_hover." + editSource[1];
        $(this).find("img").attr("src", outputSource);
    }).mouseout(function() {
        $(this).find("img").attr("src", orignalSource);
    });
}