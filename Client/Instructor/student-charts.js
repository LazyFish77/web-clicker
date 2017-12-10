function getCharts(studentInfo, elementName) {
    console.log(studentInfo);
    document.getElementById("chartbox").style.display = "flex";
    var dataPoints = [];
    studentInfo.forEach(q => dataPoints.push({ y: parseInt(q.points_earned), label: "day "+q.question_id }));
    chart = new CanvasJS.Chart(elementName, {
        animationEnabled: true,

        title: {
            text: studentInfo[0].student_id
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
            dataPoints
        }]
    });
    chart.render();
}

function searchByStudent() {
    var student = document.getElementById("student");
    var request = new XMLHttpRequest()
    var studentName = document.getElementById("student").value;
    if (!studentName) {
        return;
    }
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            clearChartElements();
            var elementName = createNewChartElement();
            getCharts(JSON.parse(request.responseText), elementName);
        }
    }
    request.open("GET", "./get-scores.php");
    request.setRequestHeader("search-by-student", studentName)
    request.send();
}

function showAllStudents() {
    var request = new XMLHttpRequest()
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status === 200) {
            clearChartElements();
            console.log(request.responseText);
            var response = JSON.parse(request.responseText);
            var students = groupBy(response, "student_id");
            students = toArray(students)
            students.forEach(student => {
                var elementName = createNewChartElement();
                getCharts(student, elementName);
            })

        }
    }
    request.open("GET", "./get-scores.php");
    request.setRequestHeader("search-by-student", "false");
    request.send();
}
function clearChartElements() {
    var chartbox = document.getElementById("chartbox");
    while (chartbox.firstChild) {
        chartbox.removeChild(chartbox.firstChild);
    }
}
function createNewChartElement() {
    var element = document.createElement("div");
    var length = document.getElementById("chartbox").childNodes.length
    var idName = "chart" + length;
    element.setAttribute("id", idName);
    element.setAttribute("class", "chart");
    document.getElementById("chartbox").appendChild(element);
    return idName;
}
function groupBy(arr, property) {
    return arr.reduce(function (memo, x) {
        if (!memo[x[property]]) { memo[x[property]] = []; }
        memo[x[property]].push(x);
        return memo;
    }, {});
}
function toArray(obj) {
    var arr = [];
    for (student in obj) {
        console.log(student);
        arr.push(obj[student]);
    }
    return arr;

}
