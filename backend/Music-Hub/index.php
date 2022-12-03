<?php 
include "config.php";
session_start();

if(isset($_GET['logout'])) {
    if($_GET['logout'] = true) {
        session_destroy();
        header("Location:index.php");
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="assets/css/shared.css" rel="stylesheet" />
    <style>
       #menubar {
        position: relative;
       }
       #menubar ul {
        width: 100%;
        background-color: #333;
        display: flex;
        flex-direction: row;
        justify-content:space-evenly;
       }
       #menubar ul li {
        list-style-type: none;
       }

       #menubar ul li a {
        color: white;
        text-decoration: none;
        padding: 10px 30px;
        display: block;
        white-space: nowrap;
       }
        @media only screen and (max-width:820px) {
            #menubar ul li a {
                padding: 10px 10px;
            }
        }
        #page-content {
            margin: 75px;
        }
    </style>
</head>
<body>
    <section id="header">
        <a href="legal/privacy.html">Privacy Policy</a>
        <a href="legal/tnc.html">Terms & Conditions</a>
        
        <?php if(isset($_SESSION['userid'])) { ?>
            <div id="dropdown">
                <button id="drop-btn"><?php echo $_SESSION['username'] ?></button>
                <div id="dropdown-content">
                    <a href="authentication/changepwd.php">Change password</a>
                    <a href="?logout=true">Logout</a>
                </div>
            </div>
        <?php } else { ?>
            <div id="dropdown">
                <button id="drop-btn">LOGIN</button>
                <div id="dropdown-content">
                    <a href="authentication/login.php">Login into existing account</a>
                    <a href="authentication/register.php">Create a new account</a>
                </div>
            </div>
        <?php } ?>
    </section>

    <section id="branding">
        <div class="left-align-content">
            <img src="assets/branding/logo.gif" />
            <h1 id="web-title">MUSIC HUB</h1>
            <p id="web-subtitle">----------------------------------------------------<br>One stop shop for all your musical needs</p>
        </div>
        <div class="right-align-content">
            <form id="search-form" method="get" action="search.php">
                <input type="search" name="search-inp" placeholder="search songs,artists,albums,etc" />
                <button><i class="bi bi-search"></i></button>
            </form>
        </div>
    </section>

    <section id="menubar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="hits.html">New Hits</a></li>
            <li><a href="recent.html">Recently Added</a></li>
            <li><a href="favs.html">Favourites</a></li>
            <li><a href="playlist.html">Playlists</a></li>
            <li><a href="about.html">About us</a></li>
        </ul>
    </section>


    <section id="page-content">
        <h1 class="container mx-auto">Songs</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
                $sql_query = "SELECT * FROM music;";
                $result = mysqli_query($conn, $sql_query);
                while($data = mysqli_fetch_array($result)) {
            ?>

                    <div class="col">
                        <div class="card h-100">
                            <img src="assets/musicimg/<?php echo $data['image'] ?>" class="card-img-top" alt="...">
                            <audio controls class="container-fluid  zindex-sticky">
                                <source src="assets/music/<?php echo $data['link']?>" />
                            </audio>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['name'] ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                        </div>
                    </div>
            <?php
                }

            ?>
            
        </div>
    </section>


    <section id="footer">

    </section>
</body>
</html>