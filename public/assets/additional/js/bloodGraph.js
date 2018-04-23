function renderGraph(bloodDetails) {
    $('.canvasjs-chart-credit').remove();

    //Parse the JSON data (Blood count for each blood type)
    var bloodsCount = JSON.parse(bloodDetails);

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: ""
        },
        axisY: {
            title: "mL"
        },
        axisX: {
            title: "Blood Types",
        },
        data: [{
            type: "column",
            showInLegend: false,
            legendMarkerColor: "red",
            legendText: "Scale: 100 = One Hundred Blood Package",
            dataPoints: [
                { y: bloodsCount[0], label: "A+" },
                { y: bloodsCount[1], label: "A-" },
                { y: bloodsCount[2], label: "B+" },
                { y: bloodsCount[3], label: "B-"},
                { y: bloodsCount[4], label: "O+" },
                { y: bloodsCount[5], label: "O-" },
                { y: bloodsCount[6], label: "AB+" },
                { y: bloodsCount[7], label: "AB-" }
            ]
        }]
    });
    chart.render();
}
