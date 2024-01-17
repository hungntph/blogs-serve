$(document).ready(function () {
    const formBlogs = $('#blogChart').attr('data');
    const blogsData = Object.values(JSON.parse(formBlogs));
    const blogsLabel = Object.keys(JSON.parse(formBlogs));

    const formUsers = $('#userChart').attr('data');
    const usersData = Object.values(JSON.parse(formUsers));
    const usersLabel = Object.keys(JSON.parse(formUsers));

    const blog = document.getElementById('blogChart');
    chartData(blog, 'bar', blogsLabel, blogsData)

    const user = document.getElementById('userChart');
    chartData(user, 'bar', usersLabel, usersData)
})

function chartData(ctx, type, labels, datas) {
    new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: 'Data',
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
