<?php
    include("../inc/database.class.php");
    include("../inc/query.class.php");
    $query = new Query();
    $categories = $query->getAllQuery("SELECT * FROM categories");
?>


<section class="form-content">
		<h1>Uploaden</h1>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br/>
    Category: <select id="product_category" name="product_category">
    <?php
        foreach($categories as $category){
            echo "<option value='" . $category["ID"] . "'>" . $category["CatName"] . "</option>";
        }
    ?>
    </select><br/>
    <input type="text" name="product_name" placeholder="product_name"><br/>
    <input type="text" name="product_price" placeholder="product price"><br/>
    <textarea style="height: 200px; width:500px;" name="product_description" id="product_description" placeholder="product description"></textarea><br/>
    <textarea style="height: 200px; width:500px;" height="500" width="200" name="product_specifications" placeholder="product specifications"></textarea><br/>
    <input type="submit" value="Upload Image" name="submit">
    </form>
	</section>