<?PHP 
    require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
    $session = new Session();
?>
<!DOCTYPE html>
<html>
  
<head>
    <meta name="description" content="Allows students to review pas questions">
    <meta name="keywords" content="Review Questions">
    <meta name="author" content="Tyler Fischer, Cory Lewis, Walter Woods">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
</head>

<body>
    <?php require_once("../General/student-nav.php");?>
    <div id="reviewoldquestionscontainer">
        <h1 class="loginheader2"> Filter Questions</h1>
        <form id="queryform" action="./get-questions.php" method="GET">
            <div>
                <label id="totalpoints">Amount of points: </label>
                <input id="reviewinput1" type="number" name="points" />
            </div>
            <div>
                <label>Topic keywords: </label>
                <input id="reviewinput2" type="text" name="topic_keywords" />
            </div>
            <div>
                <label>Question type: </label>
                <select id="reviewselection1" name="question_type">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="0">Checkbox</option>
                    <option value="1">Short Answer</option>
                    <option value="2">Radio buttons</option>
                </select>
            </div>
            <div>
                <label>Section number: </label>
                <input id="reviewinput3" type="number" name="section" step="0.01" />
            </div>
            <input type="submit" />
            <input type="reset" />
        </form>
    </div>
    <?php require_once(realpath(dirname(__FILE__)) . '/../General/footer.php'); ?>
</body>

</html>