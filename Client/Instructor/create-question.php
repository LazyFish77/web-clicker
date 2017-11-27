<?PHP 
    require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
    require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
    $session = new Session();
?>
<!DOCTYPE html>
<html>

    <head>
        <meta name="description" content="Allows Instructor to create/modify/delete questions">
        <meta name="keywords" content="Create, modify, delete, questions">
        <meta name="author" content="Tyler Fischer">
        <meta charset="UTF-8">
        <title>Web Clicker</title>
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/login-page.css"; ?>">
    </head>

<body>
    <?php require_once("../General/instructor-nav.php") ?>
    <div id="flexbox">
        <div>
            <h1 class="loginheader">Add Question</h1>
            <form id="tallform" class="container" action="./submit-created-question.php" method="POST">
                <div>
                    <label>Question statement: </label>
                    <textarea required rows="5" cols="40" name="questionstatement"></textarea>
                </div>
                <div>
                    <label> Description of question:</label>
                    <br />
                    <textarea required rows="5" cols="40" name="descriptionofquestion"></textarea>
                </div>
                <div>
                    <label>Question type: </label>
                    <select required id="createselection1" name="questiontype">
                        <option disabled selected value> --- select an option --- </option>
                        <option value="<?PHP echo QuestionController::TYPE_SHORT_ANSWER; ?>">Text box</option>
                        <!-- <option value="select">Select</option> -->
                        <!-- <option value="tf">True or false</option> -->
                        <option value="<?PHP echo QuestionController::TYPE_RADIO; ?>">Radio buttons</option>
                        <option value="<?PHP echo QuestionController::TYPE_CHECKBOX; ?>">Checkbox</option>
                    </select>
                </div>
                <div>
                    <label>Question answer:</label>
                    <input required id="createinput1" type="text" name="questionanswer" />
                </div>
                <div>
                    <label>Number of points:</label>
                    <input required type="number" name="numberofpoints" />
                </div>
                <div>
                    <label>Keywords:</label>
                    <input required id="createinput3" type="text" name="topickeywords" />
                </div>
                <div>
                    <label>Section number: </label>
                    <input required id="createinput4" type="number" name="sectionnumber" />
                </div>
                <input class="newpasswordsubmit" type="submit" />
                <input class="newpasswordclear" type="reset" />
            </form>
        </div>
        <div>
            <h1 class="loginheader">Edit Question</h1>
            <form class="container" action="./get-question.php" method="POST">
                <div>
                    <label>Select question by name or id to delete: </label>
                </div>
                <div>
                    <label>By question name: </label>
                    <input type="text" name="questionname" />
                </div>
                <div>
                    <label>By id:</label>
                    <input class="deleteinput" type="number" name="id" />
                </div>
                <input class="newpasswordsubmit" type="submit" />
                <input class="newpasswordclear" type="reset" />
            </form>
        </div>
        <div>
            <h1 class="loginheader">Delete Question</h1>
            <form class="container" action="./delete-question.php" method="POST">
                <div>
                    <label>Select question by name or id to delete: </label>
                </div>
                <div>
                    <label>By question name: </label>
                    <input type="text" name="questionname" />
                </div>
                <div>
                    <label>By id:</label>
                    <input class="deleteinput" type="number" name="id" />
                </div>
                <input type="submit" />
                <input type="reset" />
            </form>
        </div>
    </div>
    <?php require_once('../General/footer.php')?>
</body>

</html>