<section id="home-container">
    <section id="big-container">
        <section class="image100">
            <a href="#"><img src="images/categories/headers/best-sells-home.jpg" alt="best sells" class="rounded"/>
            <h1>Newest</h1></a>
        </section>

        <!-- <section class="image50">
            <a href="#"><img src="images/categories/new-releases.jpg" alt="new releases" class="rounded-right"/>
            <h1>New Releases</h1></a>
        </section> -->
    </section>

    <h1>Categories</h1>
    <section id="cat-container">
        <?php
            foreach($categories as $categorie){
                $result  = "<section class='cat-item'>";
                $result .= "<a href='categorie.php?id=" . $categorie["ID"] . "'>";
                $result .= "<img src='";
                $result .= $imagesPath . $categorie["Image"];
                $result .= "'>";
                $result .= "<h1>" . $categorie["CatName"] . "</h1>";
                $result .= "</a>";
                $result .= "</section>";
                echo $result;
            }
        ?>
    </section>
</section>