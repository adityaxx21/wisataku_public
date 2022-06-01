var total_transaksi;

$(document).ready(function () {
    passVar(chart_data);
    // $('#submit_it').submit();
});

function passVar(params) {
    function done() {
        console.log("haha");
        var url = myLine.toBase64Image('image/png');
        $('#cavas_here').val(url);

    }
    var config = {
        type: "bar",
        data: data(params),
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Banyak Order",
                    },
                },
            },
            animation: {
                onComplete: done
            },
        },
    };
    


    var myLine = new Chart(document.getElementById("myChart"), config);
    
}

if (a == "Bulanan") {
    var labels = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    var background = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)",
        "rgba(221, 203, 201, 0.2)",
        "rgba(145, 203, 172, 0.2)",
        "rgba(100, 200, 150, 0.2)",
        "rgba(212, 132, 100, 0.2)",
        "rgba(200, 200, 100, 0.2)",
    ];

    var border = [
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
        "rgba(221, 203, 201)",
        "rgba(145, 203, 172)",
        "rgba(100, 200, 150)",
        "rgba(212, 132, 100)",
        "rgba(200, 200, 100)",
    ];
} else if (a == "Mingguan") {
    var labels = [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday",
    ];

    var background = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)",
    ];

    var border = [
        "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
    ];
} else if (a == "Tahunan") {
    var labels = [];
    var background = [];
    var border = [];
    $.each(year, function (index, value) {
        labels.push(value);
        var color = [
            getRandomArbitrary(0, 255),
            getRandomArbitrary(0, 255),
            getRandomArbitrary(0, 255),
        ];
        background.push(
            "rgba(" + color[0] + ", " + color[1] + ", " + color[2] + ",0.2)"
        );
        border.push(
            "rgb(" + color[0] + ", " + color[1] + ", " + color[2] + ")"
        );
    });
}

function data(params) {
    var data = {
        labels: labels,
        datasets: [
            {
                label: "Laporan transaksi",
                data: params,
                backgroundColor: background,
                borderColor: border,
                borderWidth: 1,
            },
        ],
    };
    return data;
}

