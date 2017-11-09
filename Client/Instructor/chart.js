

window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
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
            dataPoints: [
                { y: 4, label: "e" },
                { y: 7, label: "d" },
                { y: 4, label: "c" },
                { y: 1, label: "b" },
                { y: 7, label: "a" },
            ]
        }]
    });
    chart.render();

}
