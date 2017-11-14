<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Post question to database; informs user on success">
        <meta name="keywords" content="post, questions">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            if(addQuestionToDatabase()) {
                $randomNumber = rand(1,5000);
                print_r($_POST);                
                echo "<h1 class='createquestionresponse'><span id='success'>Your question has been submitted! Question id is: $randomNumber</span></h1>";
                echo "<a class='createquestionresponse' href='../instructor/create-question.html'>Click to return</a>";
            } else {
                print_r($_POST);
                echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to submit</span></h1>";
                echo "<a class='createquestionresponse' href='../instructor/create-question.html'>Click to return</a>";
            }
            function addQuestionToDatabase(){
                return rand(0,1) === 1;
            }
        ?>
        <?php require_once('../General/footer.php')?>
    </body>
</html>