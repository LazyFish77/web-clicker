

window.onload = function () {
    var responses = getResponses();
    var question = getQuestion();
    var data = prepGraphData(question, responses);
    console.log(data);

    var chart = new CanvasJS.Chart("studentresponsechart", {
        animationEnabled: true,

        title: {
            text: "Answers"
        },
        axisX: {
            interval: 1
        },
        axisY2: {
            interlacedColor: "rgba(22,22,2,.2)",
            gridColor: "rgba(22,22,22,.5)",
            title: "Student Responses"
        },
        data: [{
            type: "bar",
            name: "answers",
            axisYType: "secondary",
            color: "#02ad02",
            dataPoints: data
        }]
    });
    chart.render();

}

function getResponses() {
    var element = document.getElementById("studentstats").childNodes[1];
    element = JSON.parse(element.innerHTML);
    console.log(element);
    return element;
}

function getQuestion() {
    var element = document.getElementById("studentstats").childNodes[3];
    element = JSON.parse(element.innerHTML);
    console.log(element);
    return element;
}

function prepGraphData(question, answers) {
    var dataPoints = []
    //this line is used for test data
    // question.options = "a, b";
    var options = question.options.split(",");
    for (let i = 0; i < answers.length; i++) {
        var value = answers.filter(a => a.answer == options[i]);
        dataPoints[i] = { y: value.length, label: options[i] };
    }
    return dataPoints;
}
