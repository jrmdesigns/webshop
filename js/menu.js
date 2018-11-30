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

    $("#cart-menu-button").click(function(){
        $("#shopping-cart-small").fadeToggle(500);
        $("#cart-menu-button > li > i").toggleClass("fa-caret-up");
    })


    $('.product-item').mouseover(function() {
        // var output = filename1.substr(0, filename1.lastIndexOf('.')) || filename1;
   
        orignalSource = $(this).find("img").attr('src');
        var editSource = orignalSource.split('.');
        var outputSource = editSource[0] + "_hover." + editSource[1];
        $(this).find("img").attr("src", outputSource);
    }).mouseout(function() {
        $(this).find("img").attr("src", orignalSource);
    });
    

    $('.image-thumb-button').click(function(){
        buttonArray = document.getElementsByClassName("image-thumb-button")
        imageSrc = $(this).attr("src");
        for(i = 0; i < buttonArray.length; i++){
            buttonArray[i].id="";
        }

        $("#big-product-image").attr("src", imageSrc);
        $(this).attr("id", "thumb-active");
    });

    $('.color-button').click(function(){
        imageSource = $(".can-change").attr("src");
        splitColor = imageSource.split("_");
        splitExtension = splitColor[1].split(".");
        color = $(this).find('div').attr("class");
        output = splitColor[0] + "_" +color + "." + splitExtension[1];
        $(".can-change").attr("src", output);

        if($("#big-product-image").attr("src").includes("01")){
             $("#big-product-image").attr("src", output);
        }


        buttonArray = document.getElementsByClassName("color-button");
        for(i = 0; i < buttonArray.length; i++){
            buttonArray[i].id = "";
        }

        $(this).attr("id", "color-button-active");
    });
}