window.onload = function(){
    $("#menu-button").click(function(){
            $("#sub-menu").fadeToggle(500);
            $("#sub-menu").css("display", "flex");
            // $("menu-button").toggleClass()
            $("#menu-button > li > i").toggleClass("fa-caret-up");
    });



    $("#user-menu-button").click(function(){
        $("#user-menu").slideToggle("slow");
        $("#user-menu-button > li > i").toggleClass("fa-caret-up");
    });
}