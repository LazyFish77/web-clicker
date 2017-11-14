<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows students to reset their passwords">
    <meta name="keywords" content="Password reset">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../General/login-page.css">
</head>

<body>
    <?php require_once("../General/student-nav.php");?>
    <div id="reviewoldquestionscontainer">
        <h1 class="loginheader"> Filter Questions</h1>
        <form id="queryform" action="./get-questions.php" method="GET">
            <div>
                <label id="totalpoints">Amount of points: </label>
                <input id="reviewinput1" type="number" name="totalpoints" />
            </div>
            <div>
                <label>Topic keywords: </label>
                <input id="reviewinput2" type="text" name="topickeywords" />
            </div>
            <div>
                <label>question statement: </label>
                <select id="reviewselection1">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="textbox">Text box</option>
                    <option value="select">Select</option>
                    <option value="tf">True or false</option>
                    <option value="radiobuttons">Radio buttons</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>
            <div>
                <label>Section number: </label>
                <input id="reviewinput3" type="number" />
            </div>
            <input type="submit" />
            <input type="reset" />
        </form>
    </div>
    <?php require_once('../General/footer.php')?>
</body>

</html>