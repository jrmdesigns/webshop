<?php
    require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gorilla Webshop</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- <link href="https://file.myfontastic.com/uTsK93DbmyvKn2KS4Z6CBS/icons.css" rel="stylesheet"> -->
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
                <a href="categorie.php"><li>New</li></a>
            </ul>
        </section>
        <section id="logo">
            <h1><a href="index.php">jorimeshop</a></h1>
        </section>
        <section class="right-part">
            <ul>
                <a href="#" id="user-menu-button"><li>drop <i class="fas fa-caret-down"></i></li></a>
                <a href="#"><li>link</li></a>
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
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
            <a href="#">
                <li>link</li>
            </a>
        </ul> 
    </header>