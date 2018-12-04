var orignalSource;
window.onload = function(){
    // ajax("getFromCart.php", "#shopping-cart-small-list");
    // location.reload(true);
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

    
    // document.getElementsByClassName("image-thumb-button")[0].id = "thumb-active";

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
        amount = parseInt($("#qty").val());
        color = $("#selected-color").val();
        productName = $("#product-header h1").html();
        price = $("#product-header > .price").html();
        price = parseFloat(price.split("- $")[1]);

        if(color == undefined){
            color = "default";
        }

        createItem(id, productName, amount, color,price);
    });


        cartList = document.getElementById("shopping-cart-small-list");
        itemArray = JSON.parse(localStorage.getItem("items"));
        if(itemArray == null){
            itemArray = [];
        }
    var product = function(id, name, amount, color, price){
	    this.ProductId = id,
	    this.ProductName = name,
	    this.Amount = amount,
	    this.Color = color,
	    this.Price = price
    };

    function createItem(id, name, amount, color, price){
        console.log("createItem");
        console.log(id, name, amount, color, price);

        if(itemArray != null ){
        for(i = 0; i < itemArray.length; i++){
            if(itemArray[i].ProductId == id && itemArray[i].Color == color)
            {
                itemArray[i].Amount += amount;
                price = price * amount;
                itemArray[i].Price += price;
                localStorage.setItem('items', JSON.stringify(itemArray));
                getItems();
                return;
            }
        }
    }
        price = price * amount;
        item = new product(id, name, amount, color, price);
        itemArray.push(item);

        localStorage.setItem('items', JSON.stringify(itemArray));
        getItems();
    }   

    function getItems(){
        cartList.innerHTML = "";
        itemList = JSON.parse(localStorage.getItem("items"));
        console.log(itemList);
        // for(i = 0; i < itemArray.length; i++){
        //     console.log(i);
        //     var li = document.createElement("li");
        //     var output = document.createTextNode(itemArray[i].ProductName + "Amount: " + itemArray[i].Amount + " price: $" + itemArray[i].Price);

        //     li.appendChild(output);
            
        //     cartList.appendChild(li);
        // }

        Object.keys(itemList).forEach(function(key){
            productName = itemList[key]["ProductName"];
            id = itemList[key]["ProductId"];
            color = itemList[key]["Color"];
            price = itemList[key]["Price"];
            amount = itemList[key]["Amount"];
            var li = document.createElement("li");
            // var output = "<a href='product.php?id=" + itemList[key]["ProductId"] + "'>";
            // output += "<span> x" + amount + "</span>";
            // output += "<span class='price'>" + price + "</span>";
            // output = document.createTextNode(output);
            a = document.createElement("a");
            a.href = "product.php?id=" + id;
            productName = document.createTextNode(productName);

            a.appendChild(productName);

            // amountSpan = document.createElement("span");
            // amountText = document.createTextNode(" x" + amount + " ");
            // amountSpan.appendChild(amountText);

            priceSpan = document.createElement("span");
            priceSpan.classList.add("price");
            priceText = document.createTextNode("$" +price);
            priceSpan.appendChild(priceText);


            li.appendChild(a);
            // li.appendChild(amountSpan);
            li.appendChild(priceSpan);
            
            cartList.appendChild(li);
        });
    }
    if(localStorage["items"] != undefined)
        getItems();
}