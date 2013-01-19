    var chart; 
    function requestData() {
    $.ajax({
        url: 'data.php',
        success: function(point) {
            var series = chart.series[0], 
            // shift if the series is longer than 300 samples
            shift = series.data.length > 300; 
            // add the point
            chart.series[0].addPoint(point, true, shift);
            // call it again after 10 seconds
            setTimeout(requestData, 120000);    
        },
        cache: false
    });
}
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Real-Time Temperature Variations in the city of Patras, Greece'
        },
        subtitle: {
            text: 'Data are collected from a station located at King Georges square, every 2 minutes'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 1000 * 1000
            
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Temperature (°C)',
                margin: 80
            }
        },
        series: [{
            name: 'Temperature',
            data: []
        }]
    });        
});
