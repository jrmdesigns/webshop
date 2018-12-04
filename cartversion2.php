<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
    window.onload=function(){
        cartList = document.getElementById("cart-list");
        itemArray =     [];
    var product = function(id, name, amount, color, price){
	    this.ProductId = id,
	    this.ProductName = name,
	    this.Amount = amount,
	    this.Color = color,
	    this.Price = price
    };

    function createItem(id, name, amount, color, price){

        for(i = 0; i < itemArray.length; i++){
            if(itemArray[i].ProductId == id && itemArray[i].Color == color)
            {
                itemArray[i].Amount += amount;
                price = price * amount;
                itemArray[i].Price += price;
                localStorage.setItem('items', JSON.stringify(itemArray));
                return;
            }
        }

        price = price * amount;
        item = new product(id, name, amount, color, price);
        itemArray.push(item);

        localStorage.setItem('items', JSON.stringify(itemArray));
    }   

    function getItems(){
        itemList = JSON.parse(localStorage.getItem("items"));
        for(i = 0; i < itemList.length; i++){
            var li = document.createElement("li");
            var output = document.createTextNode(itemList[i].ProductName + "Amount: " + itemList[i].Amount + " price: $" + itemList[i].Price);

            li.appendChild(output);
            
            cartList.appendChild(li);
        }
    }

    createItem(1, "Notebook", 3, "red", 18.00);
    createItem(2, "Pen", 5, "brown", 55.00);
    createItem(3, "Backpack", 5, "red", 85.00);
    createItem(3, "Backpack", 5, "red", 85.00);
    createItem(3, "Backpack", 5, "green", 85.00);

    getItems();
}
</script>
</head>
<body>
    <ul id="cart-list"></ul>
</body>
</html>