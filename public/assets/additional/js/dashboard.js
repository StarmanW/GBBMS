(function() {
    // Define fetch configs
    const fetchInit = {
        credentials: "same-origin",
    };

    // Fetch data
    fetch('/staff/hr/dashboard/data', fetchInit)
        .then(res => res.status === 200 ? res.json() : console.error(res.status))
        .then(data => {
            displayCount(data);
            renderBloodAmtGraph(data.totalBlood);
        }).catch(err => console.error(err.message));

    // Function to display counts (Donor, Nurse, Events and Bloods)
    function displayCount(dataCount) {
        $('#donorCount').text(dataCount.donorCount);
        $('#nurseCount').text(dataCount.nurseCount);
        $('#eventCount').text(dataCount.eventCount);
        $('#bloodCount').text(dataCount.bloodCount);
    }

    // Function to render blood amount graph
    function renderBloodAmtGraph(bloodAmt) {
        $('.canvasjs-chart-credit').remove();

        // Create new instance of CanvasJS Chart
        const chart = new CanvasJS.Chart("chartContainer", {
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
                    { y: bloodAmt[0], label: "A+" },
                    { y: bloodAmt[1], label: "A-" },
                    { y: bloodAmt[2], label: "B+" },
                    { y: bloodAmt[3], label: "B-"},
                    { y: bloodAmt[4], label: "O+" },
                    { y: bloodAmt[5], label: "O-" },
                    { y: bloodAmt[6], label: "AB+" },
                    { y: bloodAmt[7], label: "AB-" }
                ]
            }]
        }).render();
    }
})();
