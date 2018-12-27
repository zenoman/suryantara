$(document).ready(function() {
    console.log(11);

    var barChart = c3.generate({
        bindto: '#bar-chart',
        data: {
            columns: [
                ['Pengiriman', 30, 200, 100, 400, 150, 250,10]
            ],
            type: 'bar'
        },axis: {
        x: {
            type: 'category',
            categories: ['21-12-2018', '22-12-2018', '23-12-2018', '24-12-2018', '25-12-2018', '26-12-2018', '27-12-2018']
        }
    },   
        bar: {
            width: {
                ratio: 0.5
            }
        }
    });

   
});
