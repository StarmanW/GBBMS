function renderGraph(bloodDetails = null) {
    $('.canvasjs-chart-credit').remove();
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "Blood Type's Amount"
        },
        axisY: {
            title: "Packages"
        },
        axisX: {
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
    chart.render();
}
