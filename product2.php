<?php
header('Content-Type: text/html; charset=utf-8');
require_once("inc/header.php");

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){
    ?>

    <section id="product-wrapper" style="flex-direction:column; align-items:center">
        <h2>Sorry</h2>
        <p>Product not found</p>
    </section>
    <?php
    require_once("inc/footer.php");
    exit;
    } else{
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE ID = '$id'";
    $sqlResult = mysqli_query($dbConnect, $sql);
    $sqlData = array();

    while($row = mysqli_fetch_assoc($sqlResult)){
        $sqlData[] = $row;
    }
    foreach($sqlData as $data){
        $price = str_replace(".00", "",$data["Price"]);
        $colorArray = explode(', ', $data["Colors"]);
        $imageArray = explode(', ', $data["Images"]);
?>

<section id="product-wrapper">
    <section id="product-container">
        <section class="row">
            <section id="product-header">
                <h1><?php echo $data["ProductName"]; ?></h1>
                <span class="price">- $<?php echo $price; ?></span>
            </section>
            <label class="switch"><span style="margin-left:-100px; font-size:28px;">Admin: </span>
  <input type="checkbox" id="checkbox">
  <span class="slider round"></span>
</label>
        </section>

        <section class="row">
            <section id="product-images-container">
                    <?php
                    $i = 0;
                    foreach($imageArray as $image){
                        $i++;
                        if($i == 1){
                            echo '<img class="image-thumb-button can-change" src="images/' . $image . '" alt="">';
                        } else{ 
                            echo '<img class="image-thumb-button" src="images/' . $image . '" alt="">';
                        }
                    }
                    ?>
                    <img id="addImage" src="images/add.png" style="width:50%;">
            </section>

            <section id="product-images-big-image">
                    <img src="images/<?php echo $imageArray[0]; ?>" alt="" id="big-product-image">
            </section>

            <section id="product-image-options">
                <form action=""  class="rounded">
                    <section class="form-group">
                        <label for="input">Amount:</label>
                        <input type="number" id="qty" min="1" value="1"/>
                    </section>
                            <?php
                            $i = 0;
                            $countArray = count($colorArray);

                            if($countArray != 1)
                            foreach($colorArray as $color){
                                $i++;
                                if($i == 1){
                                    $output  = "<section class='form-group color-form'>";
                                    $output .= "<label>Color:</label>";
                                    $output .= "<div id='color-buttons'>";
                                    $output .= "<div class='edit-color' id='edit-button' style='display:none;'><img src='images/settings.png'/></div>";
                                    $output .= '<input type="hidden" id="selected-color" value="' . $color . '"/>';
                                    $output .= "<div class='color-button' id='color-button-active'>";
                                } else{
                                    $output = "<div class='color-button'>";
                                }

                                $output .= "<div class='" . $color . "'>";
                                $output .= "</div>";
                                $output .= "</div>";
                                
                                if($i == $countArray){
                                    $output .= "</div>";
                                    $output .= "</section";
                                }
                                echo $output;
                            }
                            ?>

                        </div>

                    <input type="submit" value="Add to Cart" id="add-to-cart">
                </form>

                <section id="specifications"  class="rounded">
                    <h1>SPECS</h1>
                        <ul>
                            <?php echo $data["Specifications"]; ?>
                        </ul>
                </section>
            </section>
        </section>
        <section class="row">
                <section id="product-description">
                    <?php echo $data["ProductDescription"]; ?>
                </section>
        </section>
    </section>
</section>

<section class="full-screen">
<section id='color-edit-window' style="display:none;">
    <div class="row" id="top">
        <button id="color-edit-window-close">exit</button>
    </div>

    <div class="row" id="content">
        <div id="color-container">
        <?php
        $query = new Query();
        $data = $query->query("SELECT Colors FROM products WHERE ID='$id'");
        $colors = array();
        $clr= $data["Colors"];
        if($clr != ""){
        $colors = explode(",", $clr);
        $colorsCount = count($colors);
        $index = 1;
        foreach($colors as $color){
            $html = "<div class='color'>";
            $html .= "<div class='bg-color " . $color ."'></div>";
            $html .= "<span class='color-remove'>remove";
            $html .= "<input type='hidden' value='" . $color . "'/>";
            $html .= "</span>";
            $html .= "</div>";
            echo $html;
            $index++;
        }
        }
        ?>
     </div>

        <select id="addColor">
            <option value="">Add color</option>
            <?php
            $colorsSql = new Query();
            $colorsData = $colorsSql->getAllQuery("SELECT color from colors");

            foreach($colorsData as $color){
                echo "<option>" . $color["color"] . "</option>";
            }
            ?>
        </select>
    </div>
    <h1 class="correctMessage"style="text-align:Center" id="edit-color-message">sjs</h1>
</section>



<section id="image-edit-window" style="display:none;">
    <div class="row" id="top">
        <button id="image-edit-window-close">exit</button>
    </div>
    <div id="image-edit-images-container">
        <?php
        $query = new Query();
        $imagesData = $query->query("SELECT Images FROM products WHERE ID='$id'");
        $images = array();
        $img= $imagesData["Images"];
        if($img != ""){
        $images = explode(",", $clr);
        $imageCount = count($images);
        $index = 1;
        foreach($images as $imag){
            $html = "<div class='color'>";
            $html .= "<div class='bg-color " . $imag ."'></div>";
            $html .= "<span class='color-remove'>remove";
            $html .= "<input type='hidden' value='" . $imag . "'/>";
            $html .= "</span>";
            $html .= "</div>";
            echo $html;
            $index++;
        }
        }
        ?>
     </div>
</section>
</section>
<?php
    }
    }
require_once("inc/footer.php");
?>
<script src="js/ajax.js"></script>
<script>

            id = window.location.search.substr(1)
        id = id.split("=");
        id = id[1];


    //color


    $("#edit-button").click(function(){
       $("#color-edit-window").css("display", "flex");
       $(".full-screen").fadeToggle();
       $(".full-screen").css("display","flex");
    });
    $("#color-edit-window-close").click(function(){
       $("#color-edit-window").css("display", "none");
       $(".full-screen").fadeToggle();
    });

    $("#addColor").change(function(){
        color = this.value;
        ajax("admin/ajax/addcolor.php", "#edit-color-message", "id", id, "color", color);
        setTimeout(function(){
            ajax("admin/ajax/getcolors.php", "#color-container", "id", id);
        },50);
    })

    $(".color-remove").click(function(){
        color = $(this).find("input").val();
        color = color.split(' ').join('');
        console.log(color);
        ajax("admin/ajax/removecolor.php", "#edit-color-message", "id", id, "color", color);
        setTimeout(function(){
            ajax("admin/ajax/getcolors.php", "#color-container", "id", id);
        },50);
    });

    // addImage

    $("#addImage").click(function(){
        $("#image-edit-window").css("display", "flex");
       $(".full-screen").fadeToggle();
       $(".full-screen").css("display","flex");
    });

    $("#image-edit-window-close").click(function(){
       $("#image-edit-window").css("display", "none");
       $(".full-screen").fadeToggle();
    });


    // admin panel
    
    $("#checkbox").change(function(){
        
        if(document.getElementById('checkbox').checked) {
            $("#edit-button").css("display","flex");
        productDescriptionText = $("#product-description").html();
        // productDescriptionText = $("#product-description").html();
        productDescriptionText = productDescriptionText.trim();
        productDescriptionWidth = $("#product-description").width();
        productDescriptionHeight = $("#product-description").height();
        
        productSpecificationsText = $("#specifications ul").html();
        productSpecificationsText = productSpecificationsText.trim();
        productSpecificationsWidth = $("#specifications ul").width();
        productSpecificationsHeight = $("#specifications ul").height();

        $("#product-description").replaceWith($("<textarea id='product-description-edit'>" + productDescriptionText + "</textarea>" ));
        $("#product-description-edit").css("min-width", productDescriptionWidth);
        $("#product-description-edit").css("min-height",productDescriptionHeight);

        
        $("#specifications ul").replaceWith($("<textarea id='product-specifications-edit'>" + productSpecificationsText + "</textarea>" ));
        $("#product-specifications-edit").css("min-width", productSpecificationsWidth);
        $("#product-specifications-edit").css("min-height",productSpecificationsHeight);


        $("#product-description-edit").focusout(function() {
            // function ajax(PageTo, firstParam, FirstValue, secParam, secValue){
            newValue = $(this).val();
            newValue = newValue.replace(/(\r\n\t|\n|\r\t)/gm,"");

            console.log(newValue);
            $("#product-description-edit").replaceWith("<section id='product-description'></section>");
            ajax("admin/update-product.php", "#product-description", "id", id, "kind", "ProductDescription", "value", newValue);
        });

        $("#product-specifications-edit").focusout(function() {
            // function ajax(PageTo, firstParam, FirstValue, secParam, secValue){
            newValue = $(this).val();
            newValue = newValue.replace(/(\r\n\t|\n|\r\t)/gm,"");

            console.log(newValue);
            $("#product-specifications-edit").replaceWith("<ul></ul>");
            ajax("admin/update-product.php", "#specifications ul", "id", id, "kind", "Specifications", "value", newValue);
        });
        } else {
            alert("f");
        }
    });
</script>

<!-- fontpare -->