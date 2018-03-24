//Var declaration
var barChart;
var pieChart;

//Constant declaration for months/dates
const MONTH_NAMES = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const d = new Date();
var prevYear = d.getFullYear()-1;

//Render Bar Graph function
function renderBloodBarGraph(bloodDetails = null) {
    $('.canvasjs-chart-credit').remove();
    
    barChart = new CanvasJS.Chart("bloodBarChartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            fontFamily:'Rubik',
            text: "Total Blood Amount Donated (" + prevYear + ")"
        },
        axisY: {
            title: "Packages"
        },
        axisX: {
            fontFamily:'Rubik',
            title: "Blood Types",
        },
        data: [{
            type: "column",
            showInLegend: true,
            legendMarkerColor: "red",
            legendText: "Scale: 100 = One Hundred Blood Package",
            dataPoints: [
                { y: 920, label: "A-" },
                { y: 300, label: "A+" },
                { y: 150, label: "B-" },
                { y: 50, label: "B+"},
                { y: 223, label: "AB-" },
                { y: 520, label: "AB+" },
                { y: 660, label: "O-" },
                { y: 550, label: "O+" }
            ]
        }]
    });
    barChart.render();
}

//Render turn up rate Chart function
function renderTurnUpChart(bloodDetails = null) {
    $('.canvasjs-chart-credit').remove();
    
    pieChart = new CanvasJS.Chart("turnUpChartContainer", {
        theme: "light2",
        exportFileName: "Doughnut Chart",
        exportEnabled: false,
        animationEnabled: true,
        title:{
            fontFamily:'Rubik',
            text: "Blood Donation Turn Up Rate (" + prevYear + ")"
        },
        legend:{
            cursor: "pointer",
            itemclick: explodePie
        },
        data: [{
            type: "doughnut",
            showInLegend: true,
            toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
            indexLabel: "{name} - #percent%",
            dataPoints: [
                { y: 850, fontFamily:'Rubik', name: "Attended", color: "#0d6786" },
                { y: 200, fontFamily:'Rubik', name: "Absent", color: "#e50039" }
            ]
        }]
    });
    pieChart.render();

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.pieChart.render();
    }
}

//Render reservation rate Chart function
function renderReservationChart(bloodDetails = null) {
    $('.canvasjs-chart-credit').remove();
    
    var chart = new CanvasJS.Chart("resvChartContainer2", {
        theme: "light2",
        exportFileName: "Doughnut Chart",
        exportEnabled: false,
        animationEnabled: true,
        title:{
            fontFamily:'Rubik',
            text: "Reservation Rate (" + prevYear + ")"
        },
        legend:{
            cursor: "pointer",
            itemclick: explodePie
        },
        data: [{
            type: "doughnut",
            showInLegend: true,
            toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
            indexLabel: "{name} - #percent%",
            dataPoints: [
                { y: 240, fontFamily:'Rubik', name: "Reserved", color: "#0d6786" },
                { y: 125, fontFamily:'Rubik', name: "Not Reserved", color: "#e50039" }
            ]
        }]
    });
    chart.render();

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.pieChart.render();
    }
}
