<?php
    session_start();
    require_once("config.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Gorilla Webshop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/icons.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/responsive.css"/>
    <script src="js/jquery.js"></script>
    <script src="js/menu.js"></script>
</head>
<body>
<section id="page-wrapper">
    <header id="top-menu">
        <section class="left-part">
            <ul>
                <a href="#" id="menu-button"><li>menu <i class="fas fa-caret-down"></i></li></a>
                <a href="categorie.php"><li>new</li></a>
            </ul>
        </section>
        <section id="logo">
            <h1><a href="index.php">jorimeshop</a></h1>
        </section>
        <section class="right-part">
            <ul>
                <?php if(isset($_SESSION["logged_in"])){
                    echo "<a href='#' id='user-menu-button'><li>Account <i class='fas fa-caret-down'></i></li></a>";
                } else{
                    echo "<a href='register.php'><li>register</li></a>";
                    echo "<a href='login.php'><li>login</li></a>";
                }
                ?>
                <a href="#" id="cart-menu-button"><li>cart <i class="fas fa-caret-down"></i></li></a>
            </ul>
        </section>
    </header>

    <header id="sub-menu">


        <section class="right-part">
            <section class='link-wrapper'>
                <a href="categorie.php">
                 <span class="icon-new icon-link"></span>
                 <span class="icon-link-text">New</span>
                </a>
            </section> 
            <?php
            
            foreach($categorieData as $data){
                $result  = "<section class='link-wrapper'>";
                $result .= "<a href='categorie.php?id=" . $data["ID"] . "'>";
                $result .= $data["Icon"];
                $result .= "<span class='icon-link-text'>";
                $result .= $data["CatName"];
                $result .= "</span>";
                $result .= "</a>";
                $result .= "</section>";
                echo $result;
            }
            ?>
        </section>
    </header>

    <header id="user-menu"> 
        <ul>
            <a href="logout.php">
                <li>logout</li>
            </a>
        </ul> 
    </header>

    <section id="shopping-cart-small">
        <h1>Shopping Cart</h1>
        <ul id="shopping-cart-small-list">
        </ul>
        <a href="#"><button>Go To Cart</button></a>
    </section>