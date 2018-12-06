      <?php
      $id = $_GET["id"];
      include("../../inc/database.class.php");
      include("../../inc/query.class.php");
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
<script>
        $(".color-remove").click(function(){
        color = $(this).find("input").val();
        color = color.split(' ').join('');
        console.log(color);
        ajax("admin/ajax/removecolor.php", "#edit-color-message", "id", id, "color", color);
        setTimeout(function(){
            ajax("admin/ajax/getcolors.php", "#color-container", "id", id);
        },200);
    });
</script>