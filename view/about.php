<?php
//ABOUT PAGE TO TELL YOU ABOUT MYSELF
session_start();

require_once(__DIR__ . '/../controller/user.php');
require_once(__DIR__ . '/../controller/user_controller.php');
require_once(__DIR__ . '/../util/security.php');


Security::checkHTTPS();
//removed login ability from this page.
//this DOES remember your login from this page interestingly
//MAYBE add some sort of system where you can click on the top if you're admin versus tech to go back


?>
<html>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <!--This stylesheet is giving the ability to use custom icons from here-->
    <style>
        h1, h2, h3 {
            text-align: center;
        }
        .center {
            text-align: center;
        }
        /*^General formatting for the login*/
        html, body {
            margin: 0;
            background: #e2f7c3;
            
        }

        .banner {
            background: #009579;
            
        }
        .banner_content {
            padding: 16px;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }
        .banner_text {
            flex-grow: 1;
            line-height: 1.4;
            font-family: 'Quicksand', sans-serif;
        }
        .banner_close {
            background: none;
            border: none;
            cursor: pointer;
        }
        .banner_text, .banner_close {
            color: #ffffff;
        }
        /*Everything directly above is for general green banner*/
        .nav_bar {
            background: #a4e3f3;
            font-family: calibri;
            padding-right: 15px;
            padding-left: 15px;
        }
        .nav_div {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav_logo a {
            font-size: 35px; /* pump up size */
            font-weight: 600; /* put it in bold */
            color: #1328eb; /*Blue to stand against light blue */
        }
        li {
            list-style: none; 
            display: inline-block; /*this stops nav links from stacking */
        }
        li a {
            color: white;  /* this also goes white so the nav links can stand out more */
            font-size: 18px; /* making it a little bigger */
            font-weight: bold; /* makes it stand out more by bolding it */
            margin-right: 25px; /* spreads the links out so they don't clump */
        }
        .nav_button {
            background-color: black; 
            margin-left: 10px; 
            border-radius: 10px;
            padding: 10px; 
            width: 90px;
        }
        button a {
            color: purple;
            font-weight: bold;
            font-size: 15px;
        }
        /* Nav stuff^ */
        .about_section {
            background-color: #fecd58;
            border-radius: 25px;
            padding: 16px;
            margin: 10 auto;
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .about_section h1, .about_section h2 {
            text-align: center; /* Keep headings centered */
        }

        .about_section_content {
            display: flex;
            align-items: flex-start; /* Align image and text at the top */
            justify-content: flex-start;
            width: 100%;
            gap: 20px; /* Space between image and text */
        }

        .about_section img {
            width: 150px; /* Control the size of the image */
            border-radius: 50%; /* Optional: Make the image round */
            /*^doesn't do anything when tweaked?*/
        }

        .about_section p {
            font-size: 24px; /*increase text size*/
            text-align: left; /* Align the paragraph text to the left */
            max-width: 80%; /* Limit the paragraph width */
        }
        /*about section stuff*/
    </style>
<head>
    <title>Alex McDonald's About Page</title>
</head>
<body>
    <div class="banner">
        <div class="banner_content">
            <div class="banner_text">
                This page will tell you a little about myself.
            </div>
            <button class="banner_close" type="button">
                <span class="material-icons">
                    <!-- It might not look like it but this is taking input from googleapi
                     stylesheet to make this inner value determine what this looks like
                     You can see it at: https://fonts.google.com/icons?selected=Material+Symbols+Outlined:close:FILL@0;wght@400;GRAD@0;opsz@24&icon.size=24&icon.color=%231f1f1f
                    -->
                    close
                </span>
            </button>
        </div>
    </div>
    <!--Banner at top^-->
    <div class="nav_bar">
        <div class="nav_div">
            <div class="nav_logo">
                <a href="https://hips.hearstapps.com/hmg-prod/images/dog-puppy-on-garden-royalty-free-image-1586966191.jpg?crop=1xw:0.74975xh;0,0.190xh&resize=1200:*">Coding</a> 
            </div>
            <ul><!--These links are currently empty but I can add to them later -->
                
                <li class="nav_button"><a href="https://localhost/McDonald_Final/index.php">Home</a></li>
                <!-- This is about page <li class="nav_button"><a href="#">About</a></li> -->
                <li class="nav_button"><a href="#">Contact</a></li>
                
            </ul>
        </div>
    </div>
    <!--Navigation bar^-->
    
 <div class="about_section">
        <h1>Alex McDonald's Website</h1>
        <h2>About me:</h2>
        <div class="about_section_content">
            <img src="Professional_Photo.png" alt="Professional Photo">
            <p>I am a fresh graduate out of ECPI University who is looking to break into the coding space. I love the way many programs fit together to make something special like a Rube Goldberg machine of excellence.
                I first gained this appreciation for design after taking a web development course in 2021 that taught me about good and bad website design.
            I enjoy the feeling of being a part of a team and I think I am an excellent team player who is able to fit whatever role may be needed. 
            I've owned dogs all my life so I have a great sense of duty and promptness, waking up early and always being on time for events. Growing up with ADHD I learned the hard way about how to manage tasks and organize myself.
            In the long run, these early trials have helped increase my perseverence and work ethic as an individual greatly and I hope to succeed in taking these skills into the workplace.</p>
        </div>
    </div>
    <script>
        document.querySelector(".banner_close").addEventListener("click", function() {
            this.closest(".banner").style.display = "none";
        });
    </script>
</body>
</html>