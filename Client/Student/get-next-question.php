<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Returns question if the instructor has enabled one; 
            otherwise returns message saying could not get question">
        <meta name="keywords" content="show question">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>get Question</title>
    </head>
    <body>
        <div id="nav">
            <h1 id="navheader">Web Clicker
                <a href="../Student/next-question.html">Next question</a>
                <a href="../Student/view-old-question.html">Review</a>
                <a href="./reset-password.html">Reset password</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>    
        </div> 
        <?php 
            if(checkForActiveQuestion()) {
                echo "<div id='noquestion'>Answer this 'example'
                    <a id='returnlink' href='../Student/next-question.html'> click to return</a> </div>";
            } else {
                echo "<div id='noquestion'>There is no question to view
                    <a id='returnlink' href='../Student/next-question.html'> click to return</a> </div>";
            }
        ?>
        <?php 
            function checkForActiveQuestion() {
                return rand(0,1) === 0;
            }
        ?>
        <footer id="footer">
            <div>
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img class="footerimage" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
                </a>
            </div>
            <div>
                <a href="https://validator.w3.org/check/referer">
                    <img class="footerimage" src="http://webdev.cs.uwosh.edu/WebCLICKER/public/images/html5_logo.png" alt="\'Valid\' HTML5">
                </a>
            </div>
            <div>
                <span id="footertext">2017 - Univ. of Tyler Fischer</span>
            </div>
        </footer>
    </body>
</html>