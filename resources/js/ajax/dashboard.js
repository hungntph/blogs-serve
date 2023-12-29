$(document).ready(function () {
    const form = $('#blogChart').attr('data');
    const datas = Object.values(JSON.parse(form));
    const labels = Object.keys(JSON.parse(form));

    const blog = document.getElementById('blogChart');

    chartClass.chartData(blog, 'bar', labels, datas)
})

chartClass = {
    chartData:function (ctx, type, labels, datas) {
        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Blogs',
                    data: datas,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}
