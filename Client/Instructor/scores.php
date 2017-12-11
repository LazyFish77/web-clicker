<?PHP
require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
$session = new Session();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Shows results from student answers">
        <meta name="keywords" content="activate, question, results">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <title>Get Question</title>
        <script src="./student-charts.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>   
        <?php require_once(realpath(dirname(__FILE__)) . "/../General/instructor-nav.php") ?>
        <div id="scorebody">
            <button class="scorebutton" onclick="showAllStudents()">show all student scores</button>
        </div>  
        <div id="chartbox1">

        </div>
        

            <div id="show-chart"> 
                <div id="chart-container">
                    <div id="total-points-earned">
                        <div id="yaxis"></div>
                    </div>
                    <canvas id="mycanvas" height="400px" width="800px"></canvas>
                </div>
                <div id="xaxis">
                </div>
            </div>
            <div id="show-all-charts">
                
            </div>
        <?php require_once(realpath(dirname(__FILE__)) . '/../General/footer.php')?>
    </body>
</html>