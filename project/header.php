<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CS 518 Project Site</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/blah09.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto&display=swap" rel="stylesheet">            
    </head>
    <body>
        <nav>
            <div class="wrapper">
                <div class="navbar navbar-fixed-top" id="myTopNav">
                    <a class="nav-logo" href="index.php"><img src="./images/logo.png" style="width: 30%;"/></a>
                    <ul class="nav-menu">                        
                        <?php                       
                             if (isset($_SESSION["first_name"]) && $_SESSION['authenticated'] === true) {                               
                                echo "<li class='nav-item'>
                                        <div style=\"padding-top: 15px;\" class=\"search-container\">
                                            <form action=\"/action_page.php\">
                                            <button class='search'type=\"submit\" style='float: left;'>search</button>
                                            <input class='search'type=\"text\" name=\"search\">                                        
                                            </form>
                                        </div>
                                      </li>";
                                if($_SESSION["first_name"] === 'admin'){
                                    echo "<li class='nav-item'> <a href='admin.php' class='nav-link'>Manage Users</a></li>";
                                }
                                echo "<li class='nav-item'> <a href='dashboard.php' class='nav-link'>My Dahsboard</a></li>";
                                echo "<li class='nav-item'> <a href='includes/logout-inc.php' class='nav-link'>Logout</a></li>";
                            }
                            else{
                                echo "<li class=\"nav-item\"> <a href=\"#\" class=\"nav-link\">about</a></li>";
                                echo "<li class=\"nav-item\"> <a href=\"#\" class=\"nav-link\">contact us</a></li>";
                                echo "<li class=\"nav-item\"> <a href=\"#\" class=\"nav-link\">faq</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>  
        <div class="container">   