<?php
require_once("inc/header.php");
?>
<section id="categorie-container">
    <aside id="side-menu">
        <ul>
            <li>
                <h1>Categories</h1>
            </li>
            <a href="categorie.php">
                <li>New</li>
            </a>
            <?php
            foreach($categories as $categorie){
                $result  = "<a href='categorie.php?id=" . $categorie["ID"] . "'  >";
                $result .= "<li>";
                $result .= $categorie["CatName"];
                $result .= "</li>";
                $result .= "</a>";

                echo $result;
            }
            ?>
        </ul>
    </aside>

        <?php
            if(isset($_GET["id"])){
                $productObject = new Query();
                $catId = $_GET["id"];
                $productsSql = "SELECT * FROM products
                INNER JOIN categories ON products.CatID = categories.ID
                WHERE CatID = '$catId'";
                $productsResult = mysqli_query($dbConnect, $productsSql);
                $productsData = array();

                $catSql = "SELECT * FROM categories WHERE ID = '$catId'";
                $catResult = mysqli_query($dbConnect, $catSql);
                $catData = array();

                while ($row = mysqli_fetch_assoc($productsResult))
                {
                    $productsData[] = $row;
                }

                while ($row = mysqli_fetch_assoc($catResult))
                {
                    $catData[] = $row;
                }

                foreach($catData as $data){
                    $result  = "<section id='categorie-wrapper'>";
                    $result .= "<section id='categorie-header'>";
                    $result .= "<img src='";
                    $result .= $imagesPath . $data["HeaderImage"] . "'/>";
                    $result .= "<h1 style='font-size:40px'>" . $data["CatName"] . "</h1>";
                    $result .= "<hr/>";
                    $result .= "<section id='products-wrapper'>";
                }

                foreach($productsData as $productData){
                    $price = str_replace('.00', '', $productData['Price']);
                    $result .= "<a href='product.php?id=" . $productData["ID"] . "'>";
                    $result .= "<section class='product-item'>";
                    $result .= "<img src='";
                    $result .= $imagesPath . $productData["ImageThumb"] . "'/>";
                    $result .= "<section class='product-item-info'>";
                    $result .= "<span class='product-item-info-title'>";
                    $result .= $productData["ProductName"];
                    $result .= "</span>";
                    $result .= "<span class='product-item-info-price'>$";
                    $result .= $price;
                    $result .= "</span>";
                    $result .= "</section>";
                    $result .= "</section>";
                    $result .= "</a>";
 
                 }
                 $result .= "</section>";
                 echo $result;
            } else{
                echo "<section id='categorie-wrapper'>";
                echo "<section id='categorie-header'>";
                echo "<img src='images/categories/headers/best-sells.jpg'/>";
                echo "<h1 style='font-size:40px;margin-bottom:25px;'><b>Newest Products</b></h1>";
                foreach($categorieData as $catData)
                {   
                    $catId = $catData["ID"];
                    $productsSql = "SELECT * FROM products WHERE CatID = '$catId' ORDER BY ID DESC LIMIT 8";
                    $productsResult = mysqli_query($dbConnect, $productsSql);
                    $productsData = array();
                    while ($row = mysqli_fetch_assoc($productsResult))
                    {
                        $productsData[] = $row;
                    }
                    $result = "<h1>" . $catData["CatName"] . "</h1>";
                    $result .= "<hr/>";
                    $result .= "<section id='products-wrapper'>";
                    
                    foreach($productsData as $productData){
                    $price = str_replace('.00', '', $productData['Price']);
                    $result .= "<a href='product.php?id=" . $productData["ID"] . "'>";
                    $result .= "<section class='product-item'>";
                    $result .= "<img src='";
                    $result .= $imagesPath . $productData["ImageThumb"] . "'/>";
                    $result .= "<section class='product-item-info'>";
                    $result .= "<span class='product-item-info-title'>";
                    $result .= $productData["ProductName"];
                    $result .= "</span>";
                    $result .= "<span class='product-item-info-price'>$";
                    $result .= $price;
                    $result .= "</span>";
                    $result .= "</section>";
                    $result .= "</section>";
                    $result .= "</a>";

                    }
                    $result .= "</section>";
                    echo $result;

                }
            }
        ?>

        </section>
    </section>
</section>
<?php
require_once("inc/footer.php");
?>