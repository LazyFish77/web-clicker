

window.onload = function () {
        var elementId = "chartContainer";
        chart = new CanvasJS.Chart(elementId, {
            animationEnabled: true,
            
            title: {
                text: "Student 1"
            },
            axisX: {
                interval: 1
            },
            axisY2: {
                interlacedColor: "rgba(22,22,2,.2)",
                gridColor: "rgba(22,22,22,.5)",
                title: " "
            },
            data: [{
                type: "bar",
                name: "Student",
                axisYType: "secondary",
                color: "#02ad02",
                dataPoints: [
                    { y: 4, label: "day 1" },
                    { y: 3, label: "day 2" },
                    { y: 4, label: "day 3" },
                    { y: 5, label: "day 4" },
                    { y: 2, label: "day 5" },
                ]
            }]
        });
        chart.render();
    
        
}
