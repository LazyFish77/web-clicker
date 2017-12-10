<?PHP
    $isQuestionsActive = "";
    $isActivateActive = "";
    $isScoresActive = "";
    $isChangePassActive = "";
    $isResetPassActive = "";

    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage == "create-question.php") {
        $isQuestionsActive = "ui-nav-active";
    }

    if($currentPage == "display-question.php") {
        $isActivateActive = "ui-nav-active";
    }

    if($currentPage == "scores.php") {
        $isScoresActive = "ui-nav-active";
    }

    if($currentPage == "change-password.php") {
        $isChangePassActive = "ui-nav-active";
    }

    if($currentPage == "reset-student-password.php") {
        $isResetPassActive = "ui-nav-active";
    }

?>
<div>
    <ul class="ui-nav-ul">
        <li class="ui-nav-left ui-nav-label"> Web Clicker</li>
        <li class="ui-nav-left"><a class="ui-nav-li-a ui-nav-left<?PHP echo $isQuestionsActive; ?>" href="../Instructor/create-question.php">Questions</a></li>
        <li class="ui-nav-left"><a class="ui-nav-li-a ui-nav-left<?PHP echo $isActivateActive; ?>" href="../Instructor/display-question.php">Activiate Question</a></li>
        <li class="ui-nav-left"><a class="ui-nav-li-a ui-nav-left <?PHP echo $isScoresActive; ?>" href="../Instructor/scores.php">Scores</a></li>
        <li class="ui-nav-left"><a class="ui-nav-li-a ui-nav-left <?PHP echo $isChangePassActive; ?>" href="../General/change-password.php">Change Password</a></li>
        <li class="ui-nav-left"><a class="ui-nav-li-a ui-nav-left <?PHP echo $isResetPassActive; ?>" href="../Instructor/reset-student-password.php">Reset Student Password</a></li>
        <li class="ui-nav-right"><a class="ui-nav-li-a ui-nav-right" href="../logout.php">Log out</a></li>
    </ul>
</div>