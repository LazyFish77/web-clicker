<?PHP
    $isNextActive = "";
    $isReviewActive = "";
    $isChangePassActive = "";

    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage == "next-question.php") {
        $isNextActive = "ui-nav-active";
    }

    if($currentPage == "view-old-question.php") {
        $isReviewActive = "ui-nav-active";
    }

    if($currentPage == "change-password.php") {
        $isChangePassActive = "ui-nav-active";
    }

?>
<div>
    <ul class="ui-nav-ul">
        <li class="ui-nav-li ui-nav-label">Web Clicker</li>
        <li class="ui-nav-li"><a class="ui-nav-li-a <?PHP echo $isNextActive; ?>" href="../Student/next-question.php">Next question</a></li>
        <li class="ui-nav-li"><a class="ui-nav-li-a <?PHP echo $isReviewActive; ?>" href="../Student/view-old-question.php">Review</a></li>
        <li class="ui-nav-li"><a class="ui-nav-li-a <?PHP echo $isChangePassActive; ?>" href="../General/change-password.php">Change Password</a></li>
        <li class="ui-nav-li"><a class="ui-nav-li-a ui-nav-right" href="../login.php">Log out</a></li>
    </ul>
</div>