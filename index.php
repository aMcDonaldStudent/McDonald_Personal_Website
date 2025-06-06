<?php
session_start();

require_once(__DIR__.'\controller\user.php');
require_once(__DIR__.'\controller\user_controller.php');
require_once(__DIR__.'\util\security.php');

Security::checkHTTPS();

//set the message related to login/logout functionality
$login_msg = isset($_SESSION['logout_msg']) ? 
    $_SESSION['logout_msg'] : '';

if (isset($_POST['email']) & isset($_POST['pw'])) {
    //login and password fields were set
    $user_level = UserController::validUser(
        $_POST['email'], $_POST['pw']);
        // REMOVED USER 
    if ($user_level === '1') {
        $_SESSION['admin'] = true;
        $_SESSION['user'] = false;
        $_SESSION['tech'] = false;
        header("Location: view/admin.php");
    } else if ($user_level === '2') {
        $_SESSION['admin'] = false;
        $_SESSION['tech'] = true;
        $_SESSION['user'] = false;
        header("Location: view/tech.php"); 
        //changed this  part so Tech becomes 2 and not  user
    } else {
        $login_msg = 'Failed Authentication - try again.';
    }
}
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
            color: white;
            font-weight: bold;
            font-size: 15px;
        }
        /* Everything directly above is for the navigation bar ^ */
    </style>
<head>
    <title>Alex McDonald's Login Website</title>
</head>
<body>
    <div class="banner">
        <div class="banner_content">
            <div class="banner_text">
                Are you new to the website? If so, try using the username rode2@revere.com or creator@php.com with the password of Pw1$.
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
                
                <!--We are at home <li class="nav_button"><a href="#"></a></li> -->
                <li class="nav_button"><a href="view/about.php">About</a></li>
                <li class="nav_button"><a href="#">Contact</a></li>
                
            </ul>
        </div>
    </div>
    <!--Navigation bar^-->
    <h1>Alex McDonald's Website</h1>
    <h2>Please Log in</h2>
    <form method='POST'>
        <h3>Login ID (e-mail): <input type="text" 
            name="email"></h3>
        <h3>Password: <input type="password" name="pw"></h3>
        <div class="center"> <!--This centers the button-->
            <input type="submit" value="Login" name="login">
        </div>
    </form>
    <h2><?php echo $login_msg; ?></h2>
    <script>
        document.querySelector(".banner_close").addEventListener("click", function() {
            this.closest(".banner").style.display = "none";
        });
    </script>
</body>
</html>