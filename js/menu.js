var orignalSource;
window.onload = function(){
    ajax("getFromCart.php", "#shopping-cart-small-list");

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
        $("#selected-color").val($(this).find("div").attr("class"));
        
        $(this).attr("id", "color-button-active");
    });


    $("#add-to-cart").click(function(e){
        e.preventDefault();
        id = window.location.search.substr(1);
        id = id.split('=')[1];
        amount = $("#qty").val();
        color = $("#selected-color").val();

        console.log(amount + "  "  + color + " " + id);
        ajax("addtocart.php", "#shopping-cart-small-list", "id", id, "amount", amount, "color", color);
    });

    function ajax(PageTo, output, firstParam, FirstValue, secParam, secValue, thirdParm, thirdValue){
        console.log("ajax");
        if(thirdParm != undefined){
            page = PageTo + "?" + firstParam + "=" + FirstValue + "&" + secParam + "=" + secValue + "&" + thirdParm + "=" + thirdValue;
        }
        else if(secParam != undefined){
            page = PageTo + "?" + firstParam + "=" + FirstValue + "&" + secParam + "=" + secValue; 
        } else if(firstParam != undefined){
            page = PageTo + "?" + firstParam + "=" + FirstValue;
        } else{
            page = PageTo;
        }

        console.log(output);
        console.log(page);
        $.ajax({url: page, success: function(result){
            $(output).html(result);
        }});
    }
}