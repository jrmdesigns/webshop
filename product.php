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
        </section>

        <section class="row">
            <section id="product-images-container">
                    <!-- <img class="image-thumb-button can-change" src="images/pen01_black.jpg" alt="" id="thumb-active">
                    <img class="image-thumb-button" src="images/pen02.jpg" alt="">
                    <img class="image-thumb-button" src="images/pen03.jpg" alt="">
                    <img class="image-thumb-button" src="images/pen04.jpg" alt=""> -->

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
                    <!-- <section class="form-group color-form">
                        
                        <label for="input">Color:</label>
                        
                        <div id="color-buttons"> -->
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
                            <!-- <li>Aluminum rollerball pen</li>
                            <li>Body: 5" X 0.4" • 0.85oz</li>
                            <li>Stainless steel tip width 0.6mm</li>
                            <li>Precision weighted ergonomic shape</li>
                            <li>Cartridge-based refills</li>
                            <li>Twist to open</li> -->
                        </ul>
                </section>
            </section>
        </section>
        <section class="row">
                <section id="product-description">
                    <?php echo $data["Description"]; ?>
                </section>
        </section>
    </section>

</section>
<?php
    }
    }
require_once("inc/footer.php");
?>