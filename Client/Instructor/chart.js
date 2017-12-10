

window.onload = function () {
    var responses = getResponses();
    var question = getQuestion();
    assignXValues(question);
    assignYValues(responses);
    var options = question.options;
    options = options.split("||");
    getCharts(options, responses);
}
function assignYValues(responses) {
    var yaxis = document.getElementById("answer-chart-yaxis");
    for (var i = 0; i < 7; i++) {
        var div = document.createElement("div");
        div.innerHTML = i * 5;
        var margin = 50 * i;
        div.style.marginBottom = margin + "px";
        div.style.marginRight = "50px";
        div.classList = "yaxis-answer";
        yaxis.appendChild(div);
    }
}
function assignXValues(question) {
    var options = question.options;
    options = options.split("||");
    var xaxis = document.getElementById("answer-chart-xaxis");
    var i = 65;
    options.forEach(xValue => {
        var span = document.createElement("span");
        span.innerHTML = xValue;
        span.style.marginLeft = i + "px";
        xaxis.appendChild(span);
    })

}
function getCharts(options, responses) {
    var canvas = document.getElementById('answer-chart');
    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, 400, 400);
    var value = [];
    var width = 50;
    var currx = 30;
    ctx.fillStyle = "green";
    options.forEach(element => {
        var e = responses.filter(response => element == response.answer);
        if (e.length == 0) {
            var h = e.length;
            ctx.fillRect(currx, canvas.height - h * 4, width, h * 4);
        } else {
            var h = 0;
            ctx.fillRect(currx, canvas.height - h * 26, width, h * 26);
        }
        currx += width + 10;
    });
};

function getResponses() {
    var element = document.getElementById("studentstats").childNodes[1];
    element = JSON.parse(element.innerHTML);
    return element;
}

function getQuestion() {
    var element = document.getElementById("studentstats").childNodes[3];
    element = JSON.parse(element.innerHTML);
    return element;
}
function groupBy(arr, property) {
    return arr.reduce(function (memo, x) {
        if (!memo[x[property]]) { memo[x[property]] = []; }
        memo[x[property]].push(x);
        return memo;
    }, {});
}
