<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Shows results from student answers">
        <meta name="keywords" content="activate, question, results">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>get Question</title>
        <script src="./chart.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>        
        <div id="nav">
            <h1 id="navheader">Web Clicker
                <a href="../Instructor/create-question.html">Questions</a>
                <a href="../Instructor/activate-question.html">Activiate question</a>
                <a href="../Instructor/scores.php">Scores</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>    
        </div> 
        <div id="chartContainer"></div>
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