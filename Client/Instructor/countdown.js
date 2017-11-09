function startTimer() {
    var counter = document.getElementById("countdown");
    var time = 10
    counter.innerHTML = time;
    setInterval(function () {
        time--;
        counter.innerHTML = time;
        if (time === 0) {
            window.location.replace("../instructor/activate-question-results.php");
        }
    }, 1000);
}

window.onload = function () {
    startTimer()
};