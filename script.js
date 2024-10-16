function addNavButtonListeners() {
    document.getElementById('dashboardBtn').addEventListener('click', function() {
        console.log("Dashboard button clicked");
    });
    document.getElementById('analyticsBtn').addEventListener('click', function() {
        console.log("Analytics button clicked");
    });
    document.getElementById('projectsBtn').addEventListener('click', function() {
        console.log("Projects button clicked");
    });
    document.getElementById('reportsBtn').addEventListener('click', function() {
        console.log("Reports button clicked");
    });
    document.getElementById('settingsBtn').addEventListener('click', function() {
        console.log("Settings button clicked");
    });
    document.getElementById('messagesBtn').addEventListener('click', function() {
        console.log("Messages button clicked");
    });
    document.getElementById('logoutBtn').addEventListener('click', function() {
        console.log("Logout button clicked");
    });
    // New listeners for the added buttons
    document.getElementById('tablepiBtn').addEventListener('click', function() {
        console.log("Table PI button clicked");
    });
    document.getElementById('tablefinishingBtn').addEventListener('click', function() {
        console.log("Table Finishing button clicked");
    });
}


function updateCharts() {
    fetch('get_chart_data.php')
        .then(response => response.json())
        .then(data => {
            // Update Order Chart
            let orderLabels = data.tablepi.map(item => item.product_name);
            let orderData = data.tablepi.map(item => item.total_order);
            
            orderChart.data.labels = orderLabels;
            orderChart.data.datasets[0].data = orderData;
            orderChart.update();

            // Update Finishing Chart
            let finishingLabels = data.tablefinishing.map(item => item.brand);
            let finishingData = data.tablefinishing.map(item => item.result);
            
            otherChart.data.labels = finishingLabels;
            otherChart.data.datasets[0].data = finishingData;
            otherChart.update();
        })
        .catch(error => console.error('Error fetching chart data:', error));
}


const ctx1 = document.getElementById('tablepi').getContext('2d');
let orderData = {
    labels: [], 
    datasets: [{
        label: 'Total Order',
        data: [], 
        backgroundColor: ['#ffcc00', '#4caf50', '#ff5722', '#2196f3', '#9c27b0', '#e91e63', '#00bcd4', '#3f51b5', '#f44336', '#8bc34a'],


        borderWidth: 1
    }]
};
let orderChart = new Chart(ctx1, {
    type: 'bar',
    data: orderData,
    options: {
        responsive: true,
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 10
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});

var ctx2 = document.getElementById('tablefinishing').getContext('2d');
var otherChartData = {
    labels: [],
    datasets: [{
        label: 'Hasil Produksi',
        data: [], 
        backgroundColor: ['#ffcc00', '#4caf50', '#ff5722', '#2196f3', '#9c27b0', '#e91e63', '#00bcd4', '#3f51b5', '#f44336', '#8bc34a'],


        borderWidth: 1
    }]
};

var otherChart = new Chart(ctx2, {
    type: 'bar',
    data: otherChartData,
    options: {
        responsive: true,
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 10
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});


window.onload = function() {
    addNavButtonListeners(); 
    updateCharts();          
};
