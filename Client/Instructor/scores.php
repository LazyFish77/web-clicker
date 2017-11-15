<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Shows results from student answers">
        <meta name="keywords" content="activate, question, results">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. "/web-clicker/Client/login-page.css"; ?>">
        <title>get Question</title>
        <script src="./student-charts.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>        
        <?php require_once("../General/instructor-nav.php") ?>
        <div id="chartContainer"></div> 
        <?php require_once('../General/footer.php')?>
</html>