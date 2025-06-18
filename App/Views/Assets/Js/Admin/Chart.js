document.addEventListener('DOMContentLoaded', function () {
    const salesCanvas = document.getElementById('salesChart');
    if (salesCanvas) {
        const salesCtx = salesCanvas.getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['12/06', '13/06', '14/06', '15/06', '16/06', '17/06', '18/06'],
                datasets: [{
                    label: 'Vendas (R$)',
                    data: [4200, 5800, 3900, 6200, 7100, 5500, 6800],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    } else {
        console.warn("Elemento #salesChart não encontrado no DOM.");
    }

    // ORDERS - PARA O GRÁFICO DE STATUS
    const ordersCanvas = document.getElementById('ordersChart');
    if (ordersCanvas) {
        const ordersCtx = ordersCanvas.getContext('2d');
        new Chart(ordersCtx, {
            type: 'doughnut',
            data: {
                labels: ['Entregue', 'Preparando', 'A caminho', 'Cancelado'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107', 
                        '#17a2b8',
                        '#dc3545'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    } else {
        console.warn("Elemento #ordersChart não encontrado no DOM.");
    }

});