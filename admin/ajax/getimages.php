<?php
    session_start();
    if(!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin"){
        exit;
    }
      $id = $_GET["id"];
      include("../../inc/database.class.php");
      include("../../inc/query.class.php");
        $query = new Query();
        $data = $query->query("SELECT Images FROM products WHERE ID='$id'");
        $images = array();
        $img= $data["Images"];
        if($img != ""){
        $images = explode(", ", $img);
        foreach($images as $image){
            $html = "<div class='image-edit-images-container-image'>";
            $html .= "<img src ='images/" . $image ."'/>";
            $html .= "<span class='image-remove'>remove";
            $html .= "<input type='hidden' value='" . $image . "'/>";
            $html .= "</span>";
            $html .= "</div>";
            echo $html;
        }
    }
        ?>
<script>
    $(".image-remove").click(function(){
        image = $(this).find("input").val();
        image = image.split(' ').join('');
        console.log(image);
        ajax("admin/ajax/removeimage.php", "#edit-image-message", "id", id, "image", image);
        setTimeout(function(){
            ajax("admin/ajax/getimages.php", "#image-edit-images-container", "id", id);
        },500);
    });
</script>